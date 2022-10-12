<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
  	<meta name="description" content="Go2Gro Project" />
  	<meta name="keywords"    content="Assignment, Swinburne, class" />
  	<meta name="author"      content="Ryan Term Zhi Jie" /> 
	<title>Login Page: New User</title>
</head>
  <body>

	<form method="post" action="process_order.php" id="regform" novalidate="novalidate">
	   <fieldset id="register">
		 <legend>User Details</legend>
	     <p><label>First Name:</label>
	        <input type="text" name="Firstname" id="firstname" size="20"  />
	     </p>
	     <p><label>Last Name:</label>
	    	<input type="text" name="Lastname" id="lastname" size="20"  />
	     </p>
	     <p><label for="age">Enter your age</label>
	    	<input type="text" id="age" name="Age" size="3">
	     </p>
	     <p><label>Email:</label>
	    	<input type="email" name= "Email" id="email" size="20" placeholder="abc@abc.domain"/>
	     </p>
	     <p><label>Phone Number:</label>
	    	<input type="tel" name= "Phone&nbsp;Number" id="phonenumber" maxlength="12" size="10" placeholder="012-345-6789"/>
	     </p>
	     <p><label for="password">Password: </label> 
	    	<input type="text" name="Password" id="password" size="20" />
	     </p>
	     <p><label for="confirm_password">Confirm password: </label> 
	    	<input type="text" name="Confirm_Password" id="confirm_password" size="20" />
	     </p>

	    <input type="submit" id="submitButton" name="submitButton"value="Register" />
	    <input type= "reset" value="Reset Form"/>
	   </fieldset>
	</form>
  </body>
</html>