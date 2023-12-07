<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HCSDL - BTL2 </title>
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Style the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }

        /* Style sidebar links */
        .sidebar a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
        }

        /* Change color on hover */
        .sidebar a:hover {
            color: #f1f1f1;
        }

        /* Main content area */
        .content {
            margin-left: 250px;
            padding-left: 20px;
            /* Add any other styles for the main content area */
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="?controller=view">View</a>
        <a href="?controller=modify">Modify</a>
        <a href="?controller=nation">Nation</a>
        <a href="?controller=season">Season</a>
        <a href="?controller=statistic">Statistic</a>

    </div>

    <div class="content">

        <?php
        include "Model/DBConfig.php";
        $db = new Database();
        $db->connect();

        if (isset($_GET['controller'])) {
            $controller = $_GET['controller'];
        } else {
            $controller = '';
        }

        switch ($controller) {
            case 'nation':
                require_once('Controller/Nation/NationController.php');
                break;
            case 'season':
                require_once('Controller/SeasonResult/SeasonResultController.php');
                break;
            case 'statistic':
                require_once('Controller/Statistic/StatisticController.php');
                break;
            case 'view':
                require_once('Controller/View/viewController.php');
                break;
            case 'modify':
                require_once('Controller/Modify/modifyController.php');
                break;
            default:

                echo "<p>Welcome to the dashboard!</p>";
                break;
        }
        ?>
    </div>
</body>

</html>