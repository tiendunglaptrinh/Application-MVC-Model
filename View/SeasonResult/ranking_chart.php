<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Ranking</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    // Include the GetTeamRanking stored procedure
    function getTeamRanking($conn, $hostYear)
    {
        $teamRanking = array();

        // Call the stored procedure
        $getTeamRankingQuery = "CALL GetTeamRanking($hostYear)";
        $teamRankingResult = $conn->query($getTeamRankingQuery);

        if ($teamRankingResult) {
            $teamRanking = $teamRankingResult->fetch_all(MYSQLI_ASSOC);

            return $teamRanking;
        } else {
            echo "Error executing query: " . $conn->error;
            return $teamRanking; // Return an empty array or handle the error accordingly
        }
    }

    // Specify the host year
    $hostYear = 2022; // Change this to the desired host year

    // Call the getTeamRanking function
    $teamRanking = getTeamRanking($conn, $hostYear);
    ?>

    <?php
    if ($teamRanking) {
        // Create arrays for chart data
        $nationNames = [];
        $teamScores = [];

        echo "<h2>Team Ranking in $hostYear:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nation Name</th><th>Team Score</th></tr>";

        foreach ($teamRanking as $team) {
            $nationName = $team['NationName'];
            $teamScore = $team['TeamScore'];

            // Output table row
            echo "<tr>";
            echo "<td style='text-align: center;'>$nationName</td>";
            echo "<td style='text-align: center;'>$teamScore</td>";
            echo "</tr>";

            // Populate chart data arrays
            $nationNames[] = $nationName;
            $teamScores[] = $teamScore;
        }

        echo "</table>";
    } else {
        echo "Error retrieving team ranking.";
    }
    ?>

    <!-- Create canvas for the bar chart -->
    <canvas id="teamRankingChart" width="400" height="200"></canvas>

    <script>
        // Use Chart.js to create a bar chart
        var ctx = document.getElementById('teamRankingChart').getContext('2d');
        var teamRankingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nationNames); ?>,
                datasets: [{
                    label: 'Team Score',
                    data: <?php echo json_encode($teamScores); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>