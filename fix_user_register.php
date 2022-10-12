<?php  
 session_start();
if (!isset($_SESSION['err_Msg'])) {
header("location:user_register.php");
exit();// terminiate 
        }
        // **********************   from process_order.php
        // display error message  
        print_r($_SESSION['err_Msg']);
        // get values from session
       
        if (isset($_SESSION["firstname"]))    // first name
                $firstname=$_SESSION["firstname"];
        else 
                $firstname="";
         
        if (isset($_SESSION["lastname"]))    // last name
                $lastname=$_SESSION["lastname"];
        else 
                $lastname="";

        if (isset($_SESSION["age"])) //email
                $age=$_SESSION["age"];
        else 
                $age="";

        if (isset($_SESSION["email"])) //email
                $email=$_SESSION["email"];
        else 
                $email="";

        if (isset($_SESSION["phonenumber"])) //phone
                $phonenumber=$_SESSION["phonenumber"];
        else 
                $phonenumber="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
  	<meta name="description" content="Go2Gro Project" />
  	<meta name="keywords"    content="Assignment, Swinburne, class" />
  	<meta name="author"      content="Ryan Term Zhi Jie" /> 
	<title>Login Page: Fix New User Registration</title>
</head>
  <body>

	<form method="post" action="user_register_process.php" id="regform" novalidate="novalidate">
	   <fieldset id="register">
		 <legend>User Details</legend>
	     <p><label>First Name:</label>
	        <input type="text" name="firstname" id="firstname" size="20" value="<?php echo $firstname; ?>" >
	     </p>
	     <p><label>Last Name:</label>
	    	<input type="text" name="lastname" id="lastname" size="20" value="<?php echo $lastname; ?>" >
	     </p>
	     <p><label for="age">Enter your age</label>
	    	<input type="text" id="age" name="age" size="3" value="<?php echo $age; ?>">
	     </p>
	     <p><label>Email:</label>
	    	<input type="email" name= "email" id="email" size="20" placeholder="abc@abc.domain" value="<?php echo $email; ?>">
	     </p>
	     <p><label>Phone Number:</label>
	    	<input type="tel" name= "phonenumber" id="phonenumber" maxlength="12" size="10" placeholder="012-345-6789" value="<?php echo $phonenumber; ?>">
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