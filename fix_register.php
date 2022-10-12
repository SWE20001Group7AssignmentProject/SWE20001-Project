<?php  
 session_start();
if (!isset($_SESSION['err_Msg'])) {
header("location:register.php");
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
                $emailadd=$_SESSION["email"];
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
	<title>Login Page: Fix New User</title>
</head>
  <body>

	<form method="post" action="process_order.php" id="regform" novalidate="novalidate">
	   <fieldset id="register">
		 <legend>User Details</legend>
	     <p><label>First Name:</label>
	        <input type="text" name="Firstname" id="firstname" size="20" value="<?php echo $firstname; ?>" >
	     </p>
	     <p><label>Last Name:</label>
	    	<input type="text" name="Lastname" id="lastname" size="20" value="<?php echo $lastname; ?>" >
	     </p>
	     <p><label for="age">Enter your age</label>
	    	<input type="text" id="age" name="Age" size="3" value="<?php echo $age; ?>">
	     </p>
	     <p><label>Email:</label>
	    	<input type="email" name= "Email" id="email" size="20" placeholder="abc@abc.domain" value="<?php echo $email; ?>">
	     </p>
	     <p><label>Phone Number:</label>
	    	<input type="tel" name= "Phone&nbsp;Number" id="phonenumber" maxlength="12" size="10" placeholder="012-345-6789" value="<?php echo $phonenumber; ?>">
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