<?php
    if (isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else {
        $action = '';
    }

    switch ($action){
        case 'rank':{
            require_once('View/SeasonResult/ranking_chart.php');
            break;
        }
        default:{
            require_once('View/SeasonResult/information.php');
            break;
        }
    }
?>
