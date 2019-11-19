
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
    $table = "host_tournament";


     // Create connection
    $conn= new mysqli($servername, $username, $password, $dbname);

    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit();
    }

    // We don't have the password or email info stored in sessions so instead we can get the results from the database.
    $stmt = $conn->prepare('SELECT password, email FROM accounts WHERE id = ?');
    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($password, $email);
    $stmt->fetch();
    $stmt->close();


    // Check connection: if error in connecting:
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check connection: if connection is successful:
    else
    {
        echo "Connection successful <br>";
    }

    // Form values are mapped to database fields
        $sport = $_POST['sport'];
        $host=$_POST['college'];
        $start=$_POST['startdate'];
        $end=$_POST['enddate'];
        $tournament_name=$_POST['tournament_name'];
        $tournament_venue=$_POST['tournament_venue'];
        $contact_name=$_POST['contact_name'];
        $contact_number=$_POST['contact_number'];
        
        // Query to insert values into database by matching column name
        $sql = "INSERT INTO host_tournament (Sport, Host, StartDate, EndDate, tournament_name, tournament_venue, contact_name, contact_number, Hosted_By)
        VALUES ('$sport', '$host', '$start', '$end', '$tournament_name', '$tournament_venue', '$contact_name', '$contact_number', '$email')";
        echo "Record submitted. ";

        if ($conn->query($sql) === TRUE)
        {
            echo "Redirecting... ";
            echo("<script>swal({
                  icon: 'success',
                  title: 'Congratulations!',
                  text: 'You have successfully created a torunament',
                  button: 'OK',
                  closeOnClickOutside: false
            }).then(function(){window.location='home.html'});</script>");
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
            }).then(function(){window.location='home.html'});</script>");
        }
        // Close connection
        $conn->close();

?>
