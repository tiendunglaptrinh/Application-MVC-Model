
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Data</title>
    <style>
     body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        form {
            width: 70%;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
        </style>
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


