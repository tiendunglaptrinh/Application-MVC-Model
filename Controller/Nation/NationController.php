<?php
    if (isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else {
        $action = '';
    }

    switch ($action){
        case 'insert':{
            require_once('View/Nation/insert_nation.php');
            break;
        }
        case 'update':{
            require_once('View/Nation/update_nation.php');
            break;
        }
        case 'delete':{
            require_once('View/Nation/delete_nation.php');
            break;
        }

        default:{
            require_once('View/Nation/list_nation.php');
            break;
        }
    }
?>
