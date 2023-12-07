<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Table</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .sidebar {
            background-color: #111;
            color: white;
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            display: block;
            margin-bottom: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .table-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .table-list li {
            margin-bottom: 10px;
        }

        .Modifycontent {
            margin-left: 24px;
            padding: 20px;
            
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        table td a{
            text-decoration: none;
            color:black;
        }
        table th {
            background-color: #333;
            color: white;
        }

        h2 {
            margin-top: 0;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #555;
        }
        .dashboard-link {
            display: block;
            font-size: 2rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            margin-bottom: 20px;
            /* background-color: #333; */
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .action-btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .action-btn:hover {
            background-color: #555;
        }
        .insert_btn{
            display: flex;
            justify-content: flex-end;
            margin-right: 24px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        
            <a href="http://localhost:3000/index.php" class="dashboard-link" style=" color: white;" onclick="redirectToDashboard()">Dashboard</a>
        
        <h2 style="color: white;">List of Tables</h2>
        <ul class="table-list">
            <?php foreach ($tables as $table) { ?>
                <li><a href="?controller=modify&option=show_table&table=<?php echo $table; ?>"><?php echo $table; ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="Modifycontent">
        <?php
        if (isset($columns) && isset($data_result)) {
            
            ?>
            <div class="insert_btn">
                <a href="View/Modify/modifyInsert.php?table=<?php echo $tableName; ?>&>" class="action-btn">Insert</a>
            </div>

            <table class="table table-hover" style="width: 100%;">
            <thead>
                <!-- <tr><a href="" class="" style="font-size: 2rem; color: white;" onclick="redirectToDashboard()">Dashboard</a></tr> -->
                <tr>
                    <?php foreach ($columns as $column) { ?>
                        <th><?php echo $column; ?></th>
                    <?php } ?>
                    <th>Actions</th>
                </tr>

            </thead>
                <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($data_result)) {
                        ?>
                            <tr>
                                <?php foreach ($columns as $column) { ?>
                                    <td><?php echo $row[$column]; ?></td>
                                <?php } ?>
                                <td>
                                   
                                    <a href="View/Modify/modifyUpdate.php?table=<?php echo $tableName; ?>&id=<?php echo $i; ?>" class="action-btn">Update</a>
                                    <a href="#" onclick="deleteRow(<?php echo $row['row']; ?>)" class="action-btn">Delete</a>

                                </td>
                            </tr>
                            
                        <?php
                            $i++;
                        }
                        ?>
                        
                    </tbody>
            </table>
            <?php

        
        } else {
            echo "<h2>Select a table from the sidebar to view its content.</h2>";
        }
        ?>
        <div id="deleteConfirmationModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete this row?</p>
                <div class="modal-buttons">
                    <button onclick="cancelDelete()">Cancel</button>
                    <button onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
        function redirectToDashboard() {
            console.log("back")
            window.location.replace('http://localhost:3000/index.php');
        }
        
</script>
<script>
function deleteRow(rowId) {
    if (confirm('Are you sure you want to delete this row?')) {
        window.location.href = `View/Modify/modifyDelete.php?controller=modify&modify=delete&table=<?php echo $tableName; ?>&id=${rowId}`;
    }
}
</script>