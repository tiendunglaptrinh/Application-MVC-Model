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
    $result = $db->execute($updateQuery);

    if ($result) {
        echo "Row updated successfully!";
        header('Location: http://localhost:3000/index.php?controller=modify&option=show_table&table='.$tableName);
        exit();
    } else {
        echo "Error updating row: ";
    }
}
?>
