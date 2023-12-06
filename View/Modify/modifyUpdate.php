
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Data</title>
    <!-- Add necessary styles or scripts -->
</head>
<body>
    <h2>Update <?php echo $_GET['table']; ?></h2>

    <?php
    require_once '../../Model/DBConfig.php';
    $db = new Database();
    $conn = $db->connect();
    $tableName = $_GET['table'];
    $id = $_GET['id'];
    $offset = $id -1;
    $result = $db->execute("SELECT * FROM $tableName LIMIT 1 OFFSET $offset"); 

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <form action="update_process.php" method="post">
            <?php
            foreach ($row as $columnName => $columnValue) {
                ?>
                <label for="<?php echo $columnName; ?>"><?php echo $columnName; ?>:</label>
                <input type="text" id="<?php echo $columnName; ?>" name="<?php echo $columnName; ?>" value="<?php echo htmlspecialchars($columnValue); ?>"><br>
                <?php
            }
            ?>
            <input type="hidden" name="table" value="<?php echo $_GET['table']; ?>">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="submit" name="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Error fetching data.";
    }
    
    ?>

</body>
</html>


