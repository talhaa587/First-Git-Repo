<html>
    <head>
        <title>My Back End Development Project</title>
    </head>
    <body>
        <h1>Welcome to our School Management System</h1>
 
        <p>Choose what you would like to do</p>
 
        <a href="addstudent.php">Add a Student</a>
        <a href="addparent.php">Add a Parent</a>
        <a href="addteacher.php">Add a teacher</a>
        <a href="seestudent.php">See all Students</a>
        <a href="seeparent.php">See all parents</a>
        <a href="seeteacher.php">See all Teachers</a>
        <a href="deleteparent.php">Delete a Parent</a>
        <a href="updateparent.php">Update a Parent</a>
        <br><br>
 
        <h3>Select a Parent to update</h3>
 
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 
        <label>Select Parent:</label>
        <select name="parentID">
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "myschool";
 
            // Create connection
            $link = new mysqli($servername, $username, $password, $dbname);
 
            // Check connection
            if ($link->connect_error) {
                die("Connection failed: ". $link->connect_error);
            }
 
            //Fetch parents from the database
            $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['ParentID']}'>{$row['ParentName']}</option>";
            }
           ?>
            </select>
            <br><br>
 
            <label>New Parent Name:</label>
            <input type="text" name="newParentName">
            <br><br>
            <input type="submit" name="submit" value="Update Parent">
            </form>
 
            <?php
            // Form submission handling
            if (isset($_POST['submit'])) {
                $parentID = $_POST['parentID'];
                $newParentName = $_POST['newParentName'];
 
                // SQL Update Query to update the selected parent's name
                $sql = "UPDATE Parents SET ParentName = '$newParentName' WHERE ParentID = '$parentID'";
 
                if ($link->query($sql) === TRUE) {
                    echo "Record updated successfully.<br>";
                } else {
                    echo "Error updating record: ". $link->error. "<br>";
                }
            }
            // Close the database connection
            $link->close();
           ?>
   
    </body>
</html>
