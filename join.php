<?php
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

$sql = "SELECT Sport, Host FROM host_tournament";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Sport " . $row["sport"]. " - Host " . $row["college"]. " " . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 