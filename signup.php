<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
</html>
<?php

    // Credentials to access MySQL database
    // $servername = "localhost";
    // $username = "sportsforum";
    // $password = "sp0rtsf0rum";
    // $dbname = "sportsforum";
    // //$table = "data";
    // $table = "registration";

    // // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);

    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    // else
    // {
    //     echo "Connection successful <br>";
    // }

    // // Form values are mapped to database fields
     
    //     $name=$_POST['name'];
    //     $srn=$_POST['srn'];
    //     $email=$_POST['email'];
    //     $dob=$_POST['dob'];
    //     $gender=$_POST['gender'];
    //     $college=$_POST['college'];
    //     $course = $_POST['course'];
    //     $semester = $_POST['semester'];
    //     $sports = $_POST['sports'];
    //     $password = $_POST['password'];

    //     //encrypting password
    //     $ciphering = "AES-128-CTR"; //assigning encryption method
    //     $iv_length = openssl_cipher_iv_length($ciphering); //assigning initialization vector length, which is not NULL
    //     $options = 0; 
    //     $encryption_iv = '1234567891011121'; //encryption initialization vector
    //     $encryption_key = 'SportsForum';

    //     $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv); 

    //     // Query to insert values into database
    //     $sql="INSERT INTO registration (Name, SRN, Email, DOB, Gender, College, Course, Semester, Sports,Password)
    //     VALUES ('$name', '$srn', '$email', '$dob', '$gender', '$college','$course', '$semester', '$sports','$encryption')";
    //     echo "Record submitted. ";

    //     if ($conn->query($sql) === TRUE)
    //     {
    //         echo "Redirecting... ";
    //         echo("<script>swal({
    //               icon: 'success',
    //               title: 'Congratulations!',
    //               text: 'You are now registered as a Hoop user!',
    //               button: 'OK',
    //               closeOnClickOutside: false
    //         }).then(function(){window.location='login.html'});</script>");
    //     }
        
    //     // Error message for unsuccessful attempt
    //     else
    //     {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //         echo("<script>swal({
    //               icon: 'error',
    //               title: 'Oops!',
    //               text: 'There's an error on our end :(. Contact us!',
    //               button: 'OK',
    //               closeOnClickOutside: false
    //         }).then(function(){window.location='login.html'});</script>");
    //     }
    //     // Close connection
    //     $conn->close();

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'sportsforum';
$DATABASE_PASS = 'sp0rtsf0rum';
$DATABASE_NAME = 'sportsforum';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	die ('Please complete the registration form');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	} else {
        // Insert new account
        // Username doesnt exists, insert new account
        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
			echo 'You have successfully registered, you can now login!';
			// echo '<script>  window.location = "index.html"; </script>';
			echo " Redirecting... ";
            echo("<script>swal({
                  icon: 'success',
                  title: 'Congratulations!',
                  text: 'You are now registered as a Hoop user!',
                  button: 'OK',
                  closeOnClickOutside: false
            }).then(function(){window.location='login.html'});</script>");
        } else {
            // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
            echo 'Could not prepare statement!';    
        }
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?> 



