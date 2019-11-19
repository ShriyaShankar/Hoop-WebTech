<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'sportsforum';
$DATABASE_PASS = 'sp0rtsf0rum';
$DATABASE_NAME = 'sportsforum';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

echo "<br> <br> <br>";

$sql = "SELECT * FROM host_tournament";
$result = $con->query($sql);
echo "You can edit the following tournament(s): ";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($email == $row["Hosted_By"])
        echo  $row["tournament_name"]. " ";
    }
}

?>

<!DOCTYPE html>
<html>
	<head>
	<ul id = "nav_bar">
    
	<li class="navLi"><a id="nav1" href = "home.html">Home</a></li>
	<li class="navLi"><a id="nav2" href = "faq.html">FAQs</a></li>
	<li class="navLi" id="litext">HOOP - A SPORTS FORUM</li>
	<li class="navLi" style="float:right"><a id = "nav3" href = "login.html">Logout</a></li>
	<li class="navLi" style="float:right"><a id = "nav3" href = "about.html">About/Contact Us</a></li>
</ul>
		<meta charset="utf-8">
		<title>Edit Tournament</title>
		<link href="main.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
	</head>
	<body id="body">
    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="editTournament">
                        <h3>Upload Rule Book</h3>
                        <div class="file btn btn-primary">
                        <input type="file">
                    </div>
                    <br> <br> <br>
                   
                    <div class="editTournament">
                        <h3>Upload Fixtures</h3>
                        <div class="file btn btn-primary">
                        <input type="file">
                    </div>
                    <br> <br> <br>
                   
                    <div class="editTournament">
                        <h3>Update Scoresheet</h3>
                        <div class="file btn btn-primary">
                        <input type="file">
                    </div>
                    <br> <br> <br>
                    
                    <div class="submit btn btn-lg btn-primary">
                        Save Changes
                    </div>
                
            </form>
	</body>
</html>