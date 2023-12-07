<script>
    </script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['modify']) && $_GET['modify'] === 'delete' && isset($_GET['id'])) {
    require_once '../../Model/DBConfig.php';
    $db = new Database();
    $conn = $db->connect();
    
    $tableName = $_GET['table'];
    $id = $_GET['id'];

    // Construct the DELETE query
    $deleteQuery = "DELETE FROM $tableName WHERE row = $id";
    echo $deleteQuery;
    // Execute the DELETE query
    try {
        $result = $db->execute($deleteQuery);
        if ($result) {
            echo "Row deleted successfully!";
            
            header('Location: http://localhost:3000/index.php?controller=modify&option=show_table&table='.$tableName);
            exit();
        } else {
            echo "Error deleting row.";
        }
    } catch (mysqli_sql_exception $e) {
        ?>
        <div style="
        text-align: center;
        
        ">
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 10px; display: inline-block;">
                Error: <?php echo $e->getMessage(); ?>
            </div>
            <a href="http://localhost:3000/index.php?controller=modify" class="button" style="text-decoration: none; background-color: #007bff; color: white; padding: 8px 16px; border-radius: 4px; display: inline-block;">Go Back</a>
        </div>
        <?php
    }
}


?>