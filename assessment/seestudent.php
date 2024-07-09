<html>
    <head>
        <title> School Management System </title>
    </head>
    <body>
        <h2> Welcome to our school Management System </h2>

        <p> Choose what you would like to do:</p>
        <a href="index.php"> Home </a>
        <a href="addstudent.php"> Add a student </a>
        <a href="addparent.php"> Add a parent </a>
        <a href="seestudent.php"> See all students </a>
        <a href="seesparent.php"> See all parents </a>
        <?php

        $link = mysqli_connect("localhost", "root", "password", "myschool");
        //Check connection
        if ($link === false) {
            die("Connection failed: ");
        }
        ?>
        <hr>

        <h3>See all students</h3>

        <table>
            <tr>
                <th width="150px">Student ID <br><hr></th>
                <th width="250px">Student Name <br><hr></th>
                <th width="150px">Parent ID <br><hr></th>
            </tr>

            <?php
            $sql = mysqli_query($link, "SELECT StudentID, StudentName, ParentID FROM Students");
            while ($row = $sql->fetch_assoc()){
            echo "
            <tr>
               <th>{$row['StudentID']}</th>
               <th>{$row['StudentName']}</th>
               <th>{$row['ParentID']}</th>
            </tr>";
            }
            ?>
         </table>
         <?php
         $link->close();
         ?>
         <hr>
    </body>
</html>