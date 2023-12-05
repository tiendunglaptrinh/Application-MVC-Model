<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Tables</title>
    
    <style>
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="http://localhost:3000/index.php" class="" style="font-size: 2rem; color: white;" onclick="redirectToDashboard()">Dashboard</a>
        <h2 style="color: white;">List of Tables</h2>
        <ul class="table-list">
            <?php foreach ($tables as $table) { ?>
                <li><a href="?controller=view&option=show_table&table=<?php echo $table; ?>"><?php echo $table; ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="viewcontent" style="">
        <?php
        if (isset($columns) && isset($data_result)) {
            // include 'table_view.php'; // Include the view for displaying table content
            ?>
            <table class="table table-hover" style="width: 100%;">
            <thead>
                <!-- <tr><a href="" class="" style="font-size: 2rem; color: white;" onclick="redirectToDashboard()">Dashboard</a></tr> -->
                <tr>
                    <?php foreach ($columns as $column) { ?>
                        <th><?php echo $column; ?></th>
                    <?php } ?>
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
    </div>
</body>
</html>


<script>
        function redirectToDashboard() {
            console.log("back")
            window.location.replace('http://localhost:3000/index.php');
        }
    </script>