<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
$host = 'localhost';
$user = 'id19669885_go2gro';
$pwd = 'SWE20001_g72022';
$sql_db = 'id19669885_go2gro_db';
// Try and connect using the info above.
$con = mysqli_connect($host, $user, $pwd, $sql_db);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email, firstname, lastname, mobile FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $fname, $lname, $mobile);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Firstname:</td>
						<td><?=$fname?></td>
					</tr>
					<tr>
						<td>Lastname:</td>
						<td><?=$lname?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>Moble:</td>
						<td><?=$mobile?></td>
					</tr>
				</table>
				<div>
				    <br> <br>
				
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a> 
				
				<a href="profile_edit.php"><i class="fas fa-edit" style='font-size:20px'></i>Edit</a> <br> <br>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
			</div>
		</div>
	</body>
</html>