<?php
    // if (isset($_GET['action'])){
    //     $action = $_GET['action'];
    // }
    // else {
    //     $action = '';
    // }

    // switch ($action){
    //     case 'topplay':{
    //         require_once('View/Statistic/Top_player.php');
    //         break;
    //     }
    //     case 'sponsor':{
    //         require_once('View/Statistic/sponsor.php');
    //         break;
    //     }
    //     default:{
    //         require_once('View/SeasonResult/information.php');
    //         break;
    //     }
    // }
?>
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
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="http://localhost:3000/index.php" class="" style="font-size: 2rem; color: white;" onclick="redirectToDashboard()">Dashboard</a>
        <h2 style="color: white;">List of Tables</h2>
        <ul class="table-list">
            <li><a href="?controller=statistic&option=show_table&table=top_player">top_player</a></li>
            <li><a href="?controller=statistic&option=show_table&table=sponsor">sponsor</a></li>
        </ul>
    </div>
    <div class="viewcontent" style="">
        <?php
        if (isset($_GET['table'])) {
            $table = $_GET['table'];
            switch ($table) {
                case 'top_player':
                    require_once('View/Statistic/Top_player.php');
                    break;
                case 'sponsor':
                    require_once('View/Statistic/sponsor.php');
                    break;
                default:
                    echo "<h2>Invalid table selection</h2>";
                    break;
            }
        } else {
            echo "<h2>Select a table from the sidebar to view its content.</h2>";
        }
        ?>
    </div>

    <script>
        function redirectToDashboard() {
            console.log("back")
            window.location.replace('http://localhost:3000/index.php');
        }
    </script>
</body>
</html>
