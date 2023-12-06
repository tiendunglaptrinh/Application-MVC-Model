<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Tables</title>
    
    <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .sidebar {
            background-color: #333;
            color: white;
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            display: block;
            margin-bottom: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .table-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .table-list li {
            margin-bottom: 10px;
        }

        .viewcontent {
            margin-left: 24px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        table th {
            background-color: #333;
            color: white;
        }

        h2 {
            margin-top: 0;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #555;
        }
        .dashboard-link {
            display: block;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            margin-bottom: 20px;
            background-color: #333;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        /* .dashboard-link:hover {
            background-color: #555;
        } */
    </style>
</head>
<body>
    
    <div class="sidebar">
        <a href="http://localhost:3000/index.php" class="dashboard-link" style="font-size: 2rem; color: white;" onclick="redirectToDashboard()">Dashboard</a>
        <h2 style="color: white;">List of Tables</h2>
        <ul class="table-list">
            <?php foreach ($tables as $table) { ?>
                <li><a href="?controller=view&option=show_table&table=<?php echo $table; ?>"><?php echo $table; ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="viewcontent" style="">
        <?php
        if (isset($columns) && isset($data_result)) {
            // include 'table_view.php'; // Include the view for displaying table content
            ?>
            <table class="table table-hover" style="width: 100%;">
            <thead>
                <!-- <tr><a href="" class="" style="font-size: 2rem; color: white;" onclick="redirectToDashboard()">Dashboard</a></tr> -->
                <tr>
                    <?php foreach ($columns as $column) { ?>
                        <th><?php echo $column; ?></th>
                    <?php } ?>
                </tr>
            </thead>
                <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($data_result)) {
                        ?>
                            <tr>
                                <?php foreach ($columns as $column) { ?>
                                    <td><?php echo $row[$column]; ?></td>
                                <?php } ?>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
            </table>
            <?php


        } else {
            echo "<h2>Select a table from the sidebar to view its content.</h2>";
        }
        ?>
    </div>
</body>
</html>


<script>
        function redirectToDashboard() {
            console.log("back")
            window.location.replace('http://localhost:3000/index.php');
        }
    </script>