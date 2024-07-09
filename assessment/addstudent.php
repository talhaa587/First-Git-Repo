<!DOCTYPE html>
<html>

<head>
    <title>School Management System</title>
</head>

<body>

    <h2>Welcome to our School Management System</h2>

    <p>Choose what you would like to do:</p>
    <a href="index.php">Home</a> |
    <a href="addstudent.php">Add a student</a> |
    <a href="addparent.php">Add a parent</a> |
    <a href="seestudent.php">See all students</a> |
    <a href="seesparent.php">See all parents</a>
    <br><br>


    <h3>Add a new student</h3>
    <form method="post" action="addstudent.php">
        <label>Student Name:</label>
        <input type="text" name="StudentName">
        <br><br>

        <label>Select Parent:</label>
        <select name="ParentID">
    
	<?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "myschool";

            // Create connection
            $link = new mysqli($servername, $username, $password);

            // Check connection
            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            } else {
                echo "Connected successfully.<br>";
            }

            // Create database if not exists
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            if ($link->query($sql) === TRUE) {
                echo "Database created successfully or already exists.<br>";
            } else {
                echo "Error creating database: " . $link->error . "<br>";
            }

            // Select the database
            $link->select_db($dbname);

            // SQL to create tables if they do not exist
            $sql = "CREATE TABLE IF NOT EXISTS Parents (
                ParentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                ParentName VARCHAR(50) NOT NULL
            )";

            if ($link->query($sql) === TRUE) {
                echo "Table Parents created successfully or already exists.<br>";
            } else {
                echo "Error creating table: " . $link->error . "<br>";
            }

            $sql = "CREATE TABLE IF NOT EXISTS Students (
                StudentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                StudentName VARCHAR(50) NOT NULL,
                ParentID INT(6) UNSIGNED,
                FOREIGN KEY (ParentID) REFERENCES Parents(ParentID)
            )";

            if ($link->query($sql) === TRUE) {
                echo "Table Students created successfully or already exists.<br>";
            } else {
                echo "Error creating table: " . $link->error . "<br>";
            }

            // Fetch parents from the database
            $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['ParentID']}'>{$row['ParentName']}</option>";
            }
        ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Add Student">
    </form>


    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $StudentName = $_POST['StudentName'];
        $ParentID = $_POST['ParentID'];
        // Debug: Display input values
        //echo "StudentName: $StudentName<br>";
        //echo "ParentID: $ParentID<br>";

        // SQL Insert Query to add a new student
        $sql = "INSERT INTO Students (StudentName, ParentID) VALUES ('$StudentName',
		 '$ParentID')";

        // Debug: Display SQL query
        //echo "SQL Query: $sql<br>";
        if ($link->query($sql) === TRUE) {
            echo "New record created successfully.<br>";
        } else {
            echo "Error adding record: " . $link->error . "<br>";
        }
    }
    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>
