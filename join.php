
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
    $sql = "SELECT Sport, Host, StartDate, EndDate FROM host_tournament";
    $result = $conn->query($sql);


    //If data exists, print data
    if ($result->num_rows > 0) {
        $dates = [];
        $tournamentName = [];
        while($row = $result->fetch_assoc()) {
            // echo "Sport: " .$row['Sport']. "</br>";
            array_push($dates, $row['StartDate']);

        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo json_encode($dates);
        }
    } 
    
    else {
        echo "There are no upcoming tournaments";
    }
    //Close connection
    $conn->close();

?> 

