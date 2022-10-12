<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
  	<meta name="description" content="Go2Gro Project" />
  	<meta name="keywords"    content="Assignment, Swinburne, class" />
  	<meta name="author"      content="Ryan Term Zhi Jie" /> 
	<title>Login Page: New User Registration</title>
</head>
  <body>

	<form method="post" action="user_register_process.php" id="regform" novalidate="novalidate">
	   <fieldset id="register">
		 <legend>User Details</legend>
	     <p><label>First Name:</label>
	        <input type="text" name="firstname" id="firstname" size="20"  />
	     </p>
	     <p><label>Last Name:</label>
	    	<input type="text" name="lastname" id="lastname" size="20"  />
	     </p>
	     <p><label for="age">Enter your age</label>
	    	<input type="text" id="age" name="age" size="3">
	     </p>
	     <p><label>Email:</label>
	    	<input type="email" name= "email" id="email" size="20" placeholder="abc@abc.domain"/>
	     </p>
	     <p><label>Phone Number:</label>
	    	<input type="tel" name= "phonenumber" id="phonenumber" maxlength="12" size="10" placeholder="012-345-6789"/>
	     </p>
	     <p><label for="password">Password: </label> 
	    	<input type="text" name="password" id="password" size="20" />
	     </p>
	     <p><label for="confirm_password">Confirm password: </label> 
	    	<input type="text" name="confirm_password" id="confirm_password" size="20" />
	     </p>

	    <input type="submit" id="submitButton" name="submitButton"value="Register" />
	    <input type= "reset" value="Reset Form"/>
	   </fieldset>
	</form>
  </body>
</html>