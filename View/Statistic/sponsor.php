<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsor</title>
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
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Include the getSponsorTotalDonations function
    function getSponsorTotalDonations($conn) {
        $sponsorTotalDonations = array();

        // Use a SELECT query to get sponsor names
        $getSponsorNamesQuery = "SELECT SpsName FROM sponsor";
        $sponsorNamesResult = $conn->query($getSponsorNamesQuery);

        if ($sponsorNamesResult) {
            $sponsorNames = $sponsorNamesResult->fetch_all(MYSQLI_ASSOC);

            // Loop through each sponsor
            foreach ($sponsorNames as $sponsor) {
                $sponsorName = $sponsor['SpsName'];

                // Use a SELECT query to get the total donation for the sponsor
                $getDonationQuery = "SELECT SUM(Finance) AS TotalDonation FROM sposor_for WHERE SF_Name = '$sponsorName'";
                $result = $conn->query($getDonationQuery);

                if ($result) {
                    $row = $result->fetch_assoc();
                    $totalDonation = ($row['TotalDonation'] !== null) ? $row['TotalDonation'] : 0.00;

                    // Add the sponsor and total donation to the result array
                    $sponsorTotalDonations[] = array(
                        'SponsorName' => $sponsorName,
                        'TotalDonation' => $totalDonation
                    );
                } else {
                    echo "Error executing query: " . $conn->error;
                }
            }

            return $sponsorTotalDonations;
        } else {
            echo "Error executing query: " . $conn->error;
            return $sponsorTotalDonations; // Return an empty array or handle the error accordingly
        }
    }

    // Call the getSponsorTotalDonations function
    $sponsorTotalDonations = getSponsorTotalDonations($conn);
    ?>

    <?php
    if ($sponsorTotalDonations) {
        // Create arrays for chart data
        $sponsorNames = [];
        $totalDonations = [];

        echo "<h2>Sponsor Total Donation:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Sponsor</th><th>Total Donation</th></tr>";

        foreach ($sponsorTotalDonations as $sponsor) {
            $sponsorName = $sponsor['SponsorName'];
            $totalDonation = $sponsor['TotalDonation'];

            // Output table row
            echo "<tr>";
            echo "<td style='text-align: center;'>$sponsorName</td>";
            echo "<td style='text-align: center;'>$totalDonation</td>";
            echo "</tr>";

            // Populate chart data arrays
            $sponsorNames[] = $sponsorName;
            $totalDonations[] = $totalDonation;
        }

        echo "</table>";
    } else {
        echo "Error retrieving sponsor information.";
    }
    ?>

    <!-- Create canvas for the bar chart -->
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        // Use Chart.js to create a bar chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($sponsorNames); ?>,
                datasets: [{
                    label: 'Total Donation',
                    data: <?php echo json_encode($totalDonations); ?>,
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

</body>
</html>
``
