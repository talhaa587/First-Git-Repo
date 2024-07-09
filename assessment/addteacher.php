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
<a href="addteacher.php">Add a teacher</a> |
<a href="seestudent.php">See all students</a> |
<a href="seesparent.php">See all parents</a>
<br><br>
 
 
    <h3>Add a new teacher</h3>
<form method="post" action="addteacher.php">
<label>Teacher Name:</label>
<input type="text" name="TeacherName">
<br><br>
 
        <label>Select Department:</label>
<select name="DepartmentID">
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
            $sql = "CREATE TABLE IF NOT EXISTS Departments (
                DepartmentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                DepartmentName VARCHAR(50) NOT NULL
            )";
 
            if ($link->query($sql) === TRUE) {
                echo "Table Departments created successfully or already exists.<br>";
            } else {
                echo "Error creating table: " . $link->error . "<br>";
            }
 
            $sql = "CREATE TABLE IF NOT EXISTS Teachers (
                TeacherID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                TeacherName VARCHAR(50) NOT NULL,
                DepartmentID INT(6) UNSIGNED,
                FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
            )";
 
            if ($link->query($sql) === TRUE) {
                echo "Table Teachers created successfully or already exists.<br>";
            } else {
                echo "Error creating table: " . $link->error . "<br>";
            }
 
            // Fetch departments from the database
            $sql = $link->query("SELECT DepartmentID, DepartmentName FROM Departments");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['DepartmentID']}'>{$row['DepartmentName']}</option>";
            }
            ?>
</select>
<br><br>
<input type="submit" name="submit" value="Add Teacher">
</form>
 
 
    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $TeacherName = $_POST['TeacherName'];
        $DepartmentID = $_POST['DepartmentID'];
        // Debug: Display input values
        //echo "TeacherName: $TeacherName<br>";
        //echo "DepartmentID: $DepartmentID<br>";
 
        // SQL Insert Query to add a new teacher
        $sql = "INSERT INTO Teachers (TeacherName, DepartmentID) VALUES ('$TeacherName',
		 '$DepartmentID')";
 
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