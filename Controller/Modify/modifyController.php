<?php
require_once './Model/DBConfig.php'; 
// require_once 'sidebar.php';
class ModifyController {
    
    public function handleActions() {
        if (isset($_GET['modify'])) {
            $db = new Database();
            $conn = $db->connect();

            $tableName = $_GET['table']; // Assuming you have the table name from URL

            // Handle different actions based on the 'modify' parameter
            switch ($_GET['modify']) {
                

                case 'update':
                    // Logic for updating - Redirect or perform necessary actions
                    // For example, redirect to update page or perform update process
                    break;

                case 'delete':
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        // Logic for deletion - Perform deletion process using $id
                        // For example, execute SQL DELETE query based on the $id
                        // Example: $db->execute("DELETE FROM $tableName WHERE id = $id");

                    }
                    // Redirect back to the modify view after deletion or perform necessary actions
                    header('Location: http://localhost:3000/index.php?controller=modify&option=show_table&table='.$tableName);
                    break;

                default:
                    // Handle default case or invalid modify parameters
                    break;
            }
        }
    }

    public function showListofTables() {
        $db = new Database(); 
        $conn = $db->connect(); 

        $tables = [];

        $result = $db->execute("SHOW TABLES");
        // print_r($result);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tables[] = $row['Tables_in_db2.0'];
            }
        }

        include './View/Modify/modifyview.php';
    }
    public function showTable() {
        $db = new Database(); // Create a new instance of the Database class
        $conn = $db->connect(); // Establish a database connection

        $tables = [];

        $result = $db->execute("SHOW TABLES");

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tables[] = $row['Tables_in_db2.0'];
            }
        }
        if (isset($_GET['table'])) {
            $tableName = $_GET['table'];
            // echo $tableName;
            $db = new Database();
            $conn = $db->connect(); // Establish a database connection

            $columns = [];

            $result = $db->execute("SHOW COLUMNS FROM $tableName");

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $columns[] = $row['Field'];
                }
            }

            $data_result = $db->execute("SELECT * FROM $tableName");

            
            include './View/Modify/modifyview.php';
        }
        else{
            echo "Modifying failed!";
        }
    }
}


$modifyController = new ModifyController();

if (isset($_GET['option']) && $_GET['option'] === 'show_table') {
    $modifyController->showTable();
} else {
    $modifyController->showListofTables();
}

// $modifyController->handleActions();
?>
