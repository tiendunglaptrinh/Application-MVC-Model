<?php
    if (isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else {
        $action = '';
    }

    switch ($action){
        case 'topplay':{
            require_once('View/Statistic/Top_player.php');
            break;
        }
        case 'sponsor':{
            require_once('View/Statistic/sponsor.php');
            break;
        }
        default:{
            require_once('View/SeasonResult/information.php');
            break;
        }
    }
?>
