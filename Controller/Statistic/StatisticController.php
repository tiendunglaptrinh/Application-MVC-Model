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
