<!DOCTYPE html>
<html>
<head>
	<style>
.error {color: #FF0000;}
</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<title>User Edit Page</title>
</head>
<body>



	<div class="container">
<div class="row">
<div class="col-lg-8 col-offset-2">
<div class="page-header">
<h2>Edit Details</h2>
<br>
</div>
<form action="profile_update.php" method="post"> 
<div class="form-group">
<label>Username</label>
<input type="text" name="username" class="form-control" value="" maxlength="20" required="">
</div>
<div class="form-group">
<label>First Name</label>
<input type="text" name="fname" class="form-control" value="" maxlength="20" required="">
</div>
<div class="form-group">
<label>Last Name</label>
<input type="text" name="lname" class="form-control" value="" maxlength="20" required="">
</div>

<div class="form-group ">
<label>Email</label>
<input type="email" name="email" class="form-control" value="" maxlength="30" required="">
</div>
<div class="form-group">
<label>Mobile</label>
<input type="text" name="mobile" class="form-control" value="" maxlength="12" required="">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" class="form-control" value="" maxlength="8" required="">
</div>  
<input type="submit" class="btn btn-primary" name="edit" value="Submit"> <br>
</form>
<?php if (count($_POST)>0) echo "Submitted!"; ?>
</div>
</div>    
</div>


</body>
</html>