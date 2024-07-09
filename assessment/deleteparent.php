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
 
        <h3>Select a Parent to delete</h3>
 
        <form method="post" action="deleteparent.php">
 
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
                die("Connection failed: " . $link->connect_error);
            }
 
            // Fetch parents from the database
            $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row["ParentID"]}'>{$row['ParentName']}</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Parent">
        </form>
 
        <?php
        // Form submission handling
        if (isset($_POST['submit'])) {
            $parent = $_POST['parentID'];
 
            // sql Delete Query to remove the selected parent
            $sql = "DELETE FROM Parents WHERE ID = $parent_id";
 
            if ($link->query($sql) === TRUE) {
                echo "Record deleted successfully.<br>";
            } else {
                echo "Error deleting record: " . $link->error . "<br>";
            }
        }
 
        // Close the database connection
        $link->close();
        ?>
 
        <hr>
 
    </body>
</html>