<!DOCTYPE html>
<html>

<head>
    <title>School Management System</title>
</head>
<body>
    <h2>Welcome to our School Management System</h2>
    <p>Choose what you would like to do:</p>
    <a href="index.php">Home</a>
    <a href="addstudent.php">Add a student</a>
    <a href="addparent.php">Add a parent</a>
    <a href="seestudent.php">See all students</a>
    <a href="seesparent.php">See all parents</a>
    <a href="seesteacher.php">See all Teachers</a>
    <a href="addteacher.php">Add a Teacher</a>
    <a href="deleteparent.php">Delete a Parent</a>
    <a href="updateparent.php">Update a Parent</a>
    <hr>

    <h3>Add a new parent</h3>
    <form method="post" action="addparent.php">
        <label>Parent Name:</label>
        <input type="text" name="ParentName">
        <br><br>
        <input type="submit" name="submit">
    </form>



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


	

    // Create database if it does not exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($link->query($sql) === TRUE) {
        echo "Database created successfully or already exists.<br>";
    } else {
        echo "Error creating database: " . $link->error . "<br>";
    }

    // Select the database
    $link->select_db($dbname);

    // SQL to create the Parents table if it does not exist
    $sql = "CREATE TABLE IF NOT EXISTS Parents (
        ParentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ParentName VARCHAR(50) NOT NULL
    )";

    if ($link->query($sql) === TRUE) {
        echo "Table Parents created successfully or already exists.<br>";
    } else {
        echo "Error creating table: " . $link->error . "<br>";
    }



    // Handle form submission for adding a new parent
    if (isset($_POST['submit'])) {

        $ParentName = $_POST['ParentName'];

        // SQL Insert Query to add a new parent
        $sql = "INSERT INTO Parents (ParentName) VALUES ('$ParentName')";
        if (mysqli_query($link, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error adding record: " . mysqli_error($link);
        }
    }

    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>
