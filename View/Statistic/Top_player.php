<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db2.0";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include the getPlayerTotalGoals function
function getPlayerTotalGoals($seasonYear, $conn, $threshold = 0) {
    $totalGoals = array();
    $seasonStartYear = $seasonYear;

    // Use a SELECT query to get total goals for each player along with player details
    $getGoalsQuery = "SELECT tm.MemberCode, tm.FName, tm.LName, tm.Nationality, COUNT(*) AS TotalGoals
                 FROM goals
                 JOIN (
                     SELECT DISTINCT MatchCode, M_HYearCode
                     FROM matches
                     WHERE M_HYearCode = $seasonStartYear
                 ) AS distinct_matches
                 ON goals.Goal_Match = distinct_matches.MatchCode
                    AND goals.Goal_HYear = distinct_matches.M_HYearCode
                 JOIN team_member tm ON goals.Goal_Player = tm.MemberCode
                 GROUP BY Goal_Player";
    $goalsResult = $conn->query($getGoalsQuery);

    while ($row = $goalsResult->fetch_assoc()) {
        // Add a loop or if statement here (for example, exclude players with less than $threshold goals)
        if ($row['TotalGoals'] > $threshold) {
            $totalGoals[] = $row;
        }
    }

    // Sort the array by total goals in descending order
    usort($totalGoals, function ($a, $b) {
        return $b['TotalGoals'] - $a['TotalGoals'];
    });

    return $totalGoals;
}

// Call the getPlayerTotalGoals function
$playerTotalGoals = getPlayerTotalGoals(2022, $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
</head>
<body>
    <?php
    echo "Player Total Goals:\n";

    // Display player total goals in an HTML table
    echo "<table border='1'>";
    echo "<tr><th>Player</th><th>Nationality</th><th>Total Goals</th></tr>";
    
    foreach ($playerTotalGoals as $player) {
        echo "<tr>";
        echo "<td style='text-align: center;'>" . $player['FName'] . " " . $player['LName'] . "</td>";
        echo "<td style='text-align: center;'>" . $player['Nationality'] . "</td>";
        echo "<td style='text-align: center;'>" . $player['TotalGoals'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
