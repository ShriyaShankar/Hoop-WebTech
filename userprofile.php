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
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="main.css">
        <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="main.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body id="body">
	<ul id = "nav_bar">
    
	<li class="navLi"><a id="nav1" href = "home.html">Home</a></li>
	<li class="navLi"><a id="nav2" href = "faq.html">FAQs</a></li>
	<li class="navLi" id="litext">HOOP - A SPORTS FORUM</li>
	<li class="navLi" style="float:right"><a id = "nav3" href = "login.html">Logout</a></li>
	<li class="navLi" style="float:right"><a id = "nav3" href = "about.html">About/Contact Us</a></li>
 
  </ul>
	
		<div class="content">
			<br><br><br>
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>