<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information tournament</title>
</head>

<body>
    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db2.0";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, 3308);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Include the GetTeamStatsInYear stored procedure
    $getTeamStatsQuery = "CALL GetTeamStatsInYear(2022)";
    $teamStatsResult = $conn->query($getTeamStatsQuery);

    echo "Team Stats in 2022:\n";

    // Display team stats in an HTML table
    echo "<table border='1'>";
    echo "<tr><th>Team Name</th><th>Total Red Cards</th><th>Total Yellow Cards</th><th>Total Goals</th><th>Total Assists</th></tr>";

    while ($row = $teamStatsResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='text-align: center;'>" . $row['TeamName'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['TotalRedCards'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['TotalYellowCards'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['TotalGoals'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['TotalAssists'] . "</td>";
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