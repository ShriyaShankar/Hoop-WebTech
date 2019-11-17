<?php

    //Database credentials
    $servername = "localhost";
    $username = "sportsforum";
    $password = "sp0rtsf0rum";
    $dbname = "sportsforum";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
    // echo "Connection successful";
    }

    // Query to select respective fields from the table
    $sql = "SELECT Name, SRN, Email, Gender, College FROM registration";
    $result = $conn->query($sql);

    //If data exists, print data
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sport = $_POST['Sport'];
            $srn = $_POST['SRN'];
            $email = $_POST['Sport'];
            $sport = $_POST['Sport'];
        }
    } else {
        echo "There are no upcoming tournaments";
    }

    //Close connection
    $conn->close();
?> 