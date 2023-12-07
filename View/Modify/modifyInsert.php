<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Data</title>
    <link rel="stylesheet" href="style.css">
</head>
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
            width: 80%; /* Increased form width */
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
            width: calc(100% - 20px); /* Wider input fields */
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
        .content{
            width:100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
<body>
    <div class="content">
        <h2>Insert Data into <?php echo $_GET['table']; ?></h2>

        <?php
        require_once '../../Model/DBConfig.php';
        $db = new Database();
        $conn = $db->connect();
        $tableName = $_GET['table'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $columns = [];
            $values = [];

            // Sanitize input values
            foreach ($_POST as $key => $value) {
                if ($key !== 'submit' && $key !== 'table') {
                    $columns[] = $key;
                    $values[] = mysqli_real_escape_string($conn, $value);
                }
            }

            // Construct the query for INSERT operation
            $columnNames = implode(',', $columns);
            $columnValues = "'" . implode("','", $values) . "'";
            $insertQuery = "INSERT INTO $tableName ($columnNames) VALUES ($columnValues)";

            // Execute the INSERT query
            try {
                $result = $db->execute($insertQuery);
                if ($result) {
                    echo "Row updated successfully!";
                    header('Location: http://localhost:3000/index.php?controller=modify&option=show_table&table='.$tableName);
                    exit();
                    
                } else {
                    echo "Error inserting data.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>

        <form action="" method="post">
            <?php
            // Retrieve columns dynamically from the database
            $columnsQuery = "SHOW COLUMNS FROM $tableName";
            $columnsResult = $db->execute($columnsQuery);
            
            if ($columnsResult && $columnsResult->num_rows > 0) {
                while ($column = $columnsResult->fetch_assoc()) {
                    ?>
                    <label for="<?php echo $column['Field']; ?>"><?php echo $column['Field']; ?>:</label>
                    <input type="text" id="<?php echo $column['Field']; ?>" name="<?php echo $column['Field']; ?>"><br>
                    <?php
                }
            }
            ?>
            <input type="hidden" name="table" value="<?php echo $_GET['table']; ?>">
            <input type="submit" name="submit" value="Insert">
        </form>
    </div>
</body>
</html>
