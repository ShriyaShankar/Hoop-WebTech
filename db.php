
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
        $password = $_POST['password'];

        //encrypting password
        $ciphering = "AES-128-CTR"; //assigning encryption method
        $iv_length = openssl_cipher_iv_length($ciphering); //assigning initialization vector length, which is not NULL
        $options = 0; 
        $encryption_iv = '1234567891011121'; //encryption initialization vector
        $encryption_key = 'SportsForum';

        $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv); 

        // Query to insert values into database
        $sql="INSERT INTO registration (Name, SRN, Email, DOB, Gender, College, Course, Semester, Sports,Password)
        VALUES ('$name', '$srn', '$email', '$dob', '$gender', '$college','$course', '$semester', '$sports','$encryption')";
        echo "Record submitted. ";

        if ($conn->query($sql) === TRUE)
        {
            echo "Redirecting... ";
            echo("<script>swal({
                  icon: 'success',
                  title: 'Congratulations!',
                  text: 'You are now registered as a Hoop user!',
                  button: 'OK',
                  closeOnClickOutside: false
            }).then(function(){window.location='login.html'});</script>");
        }
        
        // Error message for unsuccessful attempt
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo("<script>swal({
                  icon: 'error',
                  title: 'Oops!',
                  text: 'There's an error on our end :(. Contact us!',
                  button: 'OK',
                  closeOnClickOutside: false
            }).then(function(){window.location='login.html'});</script>");
        }
        // Close connection
        $conn->close();

?>
