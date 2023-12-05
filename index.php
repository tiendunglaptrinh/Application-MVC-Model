<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage nation</title>
</head>
<body>
    
</body>
</html>
<?php

    include "Model/DBConfig.php";
    $db = new Database();
    $db->connect();

    if (isset($_GET['controller'])){
        $controller = $_GET['controller'];
    }
    else {
        $controller = '';
    }

    switch ($controller){
        case 'nation':{
            require_once('Controller/Nation/NationController.php');
        }
        case 'season':{
            require_once('Controller/SeasonResult/SeasonResultController.php');
        }
        case 'statistic':{
            require_once('Controller/Statistic/StatisticController.php');
        }
    }
?>
