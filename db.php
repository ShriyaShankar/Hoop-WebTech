
<!-- This code is executed after the form is submitted by user -->

<!-- For sweet alert -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
</html>

<?php

    // Credentials to access MySQL database
    $servername = "localhost";
    $username = "sportsforum";
    $password = "sp0rtsf0rum";
    $dbname = "sportsforum";
    //$table = "data";
    $table = "registration";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        echo "Connection successful <br>";
    }

    // Form values are mapped to database fields
     
        $name=$_POST['name'];
        $srn=$_POST['srn'];
        $email=$_POST['email'];
        $dob=$_POST['dob'];
        $gender=$_POST['gender'];
        $college=$_POST['college'];
        $course = $_POST['course'];
        $semester = $_POST['semester'];
        $sports = $_POST['sports'];
       
        // Query to insert values into database
        $sql = "INSERT INTO registration (Name, SRN, Email, DOB, Gender, College, Course, Semester, Sports)
        VALUES ('$name', '$srn', '$email', '$dob', '$gender', '$college','$course', '$semester', '$sports')";
        echo "Record submitted. ";


        // Close connection
        $conn->close();

?>
