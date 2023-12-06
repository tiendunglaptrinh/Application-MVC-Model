<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    require_once '../../Model/DBConfig.php';
    $db = new Database();
    $conn = $db->connect();

    $tableName = $_POST['table'];
    $id = $_POST['id'];

    // Sanitize input values (to prevent SQL injection)
    $sanitizedValues = array_map(function ($value) use ($conn) {
        return mysqli_real_escape_string($conn, $value);
    }, $_POST);

    // Build the UPDATE query
    $updateQuery = "UPDATE $tableName SET ";

    foreach ($sanitizedValues as $columnName => $columnValue) {
        if ($columnName !== 'table' && $columnName !== 'id' && $columnName !== 'submit') {
            $updateQuery .= "$columnName = '$columnValue', ";
        }
    }

    // Remove the trailing comma and space
    $updateQuery = rtrim($updateQuery, ', ');

    // Add the WHERE clause to specify the row to update based on row_order
    $updateQuery .= " WHERE row = $id";
    // echo $updateQuery;
    // Execute the update query

    try{
        $result = $db->execute($updateQuery);
        if ($result) {
            echo "Row updated successfully!";
            header('Location: http://localhost:3000/index.php?controller=modify&option=show_table&table='.$tableName);
            exit();
        }
    }
    catch(mysqli_sql_exception $e){
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
