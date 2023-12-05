<?php
require_once './Model/DBConfig.php'; // Include your DBConfig file

class ViewController {
    
    public function showListofTables() {
        $db = new Database(); 
        $conn = $db->connect(); 

        $tables = [];

        $result = $db->execute("SHOW TABLES");

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tables[] = $row['Tables_in_db2.0'];
            }
        }

        // Load the view file
        include './View/View/view.php';
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

            // Load the view file for displaying table content
            include './View/View/view.php';
        }
        else{
            echo "View table failed!";
        }
    }
}


$viewController = new ViewController();

if (isset($_GET['option']) && $_GET['option'] === 'show_table') {
    $viewController->showTable();
} else {
    $viewController->showListofTables();
}
?>
