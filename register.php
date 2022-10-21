<!DOCTYPE html>
<html>
<head>
	<style>
.error {color: #FF0000;}
</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<title>User Registration</title>
</head>
<body>

<?php

//Editor Jobenjot Singh

$usernameErr = $fnameErr = $lnameErr = $emailErr = $passwordErr ="";
    $username = $fname = $lname = $email  = $password ="";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
      $usernameErr = "Only letters and white space allowed";
    }
  }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "First Name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
    }
  }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";
  } else {
    $lname = test_input($_POST["lname"]);
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
      $lname = "Only letters and white space allowed";
    }
  }
}


    if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

    if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    
    if (!preg_match("#[0-9]+#",$password)) {
      $passwordErr = "Password format is wrong, should contain atleast 1 digit";
    }
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>








	<div class="container">
<div class="row">
<div class="col-lg-8 col-offset-2">
<div class="page-header">
<h2>Registration Form for new Members</h2>
</div>
<p>Please fill all fields in the form</p>
<form action="connect.php" method="post"> 
<div class="form-group">
<label>Username</label>
<input type="text" name="username" class="form-control" value="" maxlength="20" required="">
<span class="error">* <?php echo $usernameErr;?></span>
</div>
<div class="form-group">
<label>First Name</label>
<input type="text" name="fname" class="form-control" value="" maxlength="20" required="">
<span class="error">* <?php echo $fnameErr;?></span>
</div>
<div class="form-group">
<label>Last Name</label>
<input type="text" name="lname" class="form-control" value="" maxlength="20" required="">
<span class="error">* <?php echo $lnameErr;?></span>
</div>

<div class="form-group ">
<label>Email</label>
<input type="email" name="email" class="form-control" value="" maxlength="30" required="">
<span class="error">* <?php echo $emailErr;?></span>
</div>
<div class="form-group">
<label>Mobile</label>
<input type="text" name="mobile" class="form-control" value="" maxlength="12" required="">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" class="form-control" value="" maxlength="8" required="">
<span class="error">* <?php echo $passwordErr;?></span>
</div>  
<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="cpassword" class="form-control" value="" maxlength="8" required="">
</div>
<input type="submit" class="btn btn-primary" name="signup" value="Submit"> <br>
Already have an account?<a href="login.php" class="btn btn-default"><b>Login<b></a>
</form>
</div>
</div>    
</div>


</body>
</html>