<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Table</title>
    <style>
       
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="http://localhost:3000/index.php" class="" style="font-size: 2rem; color: white;" onclick="redirectToDashboard()">Dashboard</a>
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
                                    <a href="View/Modify/modifyDelete.php?table=<?php echo $tableName; ?>&id=<?php echo $i; ?>" class="action-btn">Delete</a>
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

        <!-- JavaScript function for delete confirmation -->
        <script>th 
            function deleteRow(rowId) {
                if (confirm('Are you sure you want to delete this row?')) {
                    window.location.href = '?modify=delete&id=' + rowId;
                }
            }
        </script>
    </div>
</body>
</html>
