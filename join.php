
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
     
        $sport = $_POST['sport'];
        $host=$_POST['college'];
        $start=$_POST['startdate'];
        $end=$_POST['enddate'];
        
        // Query to insert values into database
        $sql = "SELECT Sport, Host, StartDate, EndDate FROM host_tournament";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo $sport, $host, $start, $end;
            }
        } else {
            echo "0 results";
        }
        // Close connection
        $conn->close();

?>
