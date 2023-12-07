<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HCSDL - BTL2 </title>
    <style>
        *{
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
        .dashboarditem{
            font-weight: 700;
        }
        .default-content{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .contentdashboard{
            margin-left: 100px;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="" class = "dashboarditem"><i class='bx bxs-user' ></i>&nbsp;&nbsp;Admin Dashboard</a>
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
                
                ?>
                <div class="contentdashboard">
                    <div class="default-content">
                        <!-- Add an image -->
                        
                        
                        <!-- Add introductory text -->
                        <h1>Welcome Admin</h1>
                        <p style="margin-top: 24px;">This is the dashboard. You can manage various sections in the soccer league.</p>
                        <img src="pic\materazzi-ruicosta.webp" alt="Welcome Image" style="margin-top: 100px;">
                    </div>
                </div>
                <?php
        }
        ?>
    </div>
</body>
</html>
