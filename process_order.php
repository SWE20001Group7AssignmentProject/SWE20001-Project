<?php
session_start();
if(!isset($_SESSION['err_Msg'])){
$_SESSION['err_Msg']="";
}
if(!isset($_SESSION['db_Msg'])){
$_SESSION['db_Msg']="";
}
?>
<?php 

 require_once ("settings.php");
/* process_order.php
   validate and ensure all data inputted are correct
   Like any code you should start your file with a header comment
   Author: Ryan Term Zhi Jie
*/

function sanitise_input($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
      }

$register_time = date("d/m/Y h:i:sa");             //get the time by sever using dd/mm/yy hour:minutes:second formula
$register_status = "PENDING";

if (!isset($_POST["submitButton"])) {
        header("location:register.php");
        exit();
    }

$err_Msg = "";

if (!isset($_POST["firstname"]) && !isset($_SESSION["firstname"])){
   header("location:register.php");
        exit();
} else {
$firstname =sanitise_input($_POST["firstname"]);
        if ($firstname=="") {
         $err_Msg .= "<p>Please enter first name.</p>\n";
        }
        else if (!preg_match("/^[a-zA-Z\s]{2,25}$/",$firstname)) {
         $err_Msg .= "<p>First name can only contain max 25 alpha characters.</p>\n";
        }
}


$lastname =sanitise_input($_POST["lastname"]);
        if ($lastname=="") {
         $err_Msg .= "<p>Please enter last name.</p>\n";
        }
        else if (!preg_match("/^[a-zA-Z\s]{2,25}$/",$lastname)) {
         $err_Msg .= "<p>Last name can only contain max 25 alpha characters.</p>\n";
        }

$age =sanitise_input($_POST["age"]);
         if ($age == "") {
         $err_Msg .= "<p>Please enter your age.</p>\n";
         } else if (!is_numeric($age)) {
            $err_Msg .= "<p>Age is not numeric.</p>\n";
        }
        else if ($age < 18 || $age > 70){
         $err_Msg .= "<p class='align-center'>Age must be above 18 and 70 or below.</p>\n";
       }     

$email = sanitise_input($_POST["email"]);
        if ($email=="") {
            $err_Msg .= "<p>Please enter your email address.</p>\n";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err_Msg .= "<p>Please check your email address.</p>\n";
        }
$phonenumber = sanitise_input($_POST["phonenumber"]);
        if ($phonenumber=="") {
            $err_Msg .= "<p>Please enter your phone number .</p>\n";
        }
        else if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",$phonenumber)) {
            $err_Msg .= "<p>The maximum of phone number is 12 digits.</p>\n";
        }

$password =sanitise_input($_POST["password"]);
        if ($password=="") {
         $err_Msg .= "<p>Please enter a password.</p>\n";
        }
        else if (!preg_match("/^[A-Z]{1}[A-Za-z][#][\d]{1,3}$/",$username)) {
         $err_Msg .= "<p>Password must start with a capital letter and contain at least a # and end with a digit.</p>\n";
        }

$confirm_password =sanitise_input($_POST["confirm_password"]);
        if ($confirm_password=="") {
         $err_Msg .= "<p>Please re-enter the password.</p>\n";
        }
        else if (!preg_match($password, $confirm_password)) {
         $err_Msg .= "<p>Password re-entered must be the same with password.</p>\n";
        }

    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['age'] = $age;
    $_SESSION['email'] = $email;
    $_SESSION['phonenumber'] = $phonenumber;
 if ($err_Msg !=""){
 
    
    $_SESSION['err_Msg'] = $err_Msg;  

header("location:fix_register.php"); //pass the error to fix_order
exit();
}

$conn = @mysqli_connect($host,
$user,
$pwd,
$sql_db
);

$db_Msg="";

if (!$conn) {
// Displays an error message
$db_Msg= "<p>Unable to connect to database.</p>"; // not in production script
} else {
    $query = "CREATE TABLE IF NOT EXISTS logins (
                    register_id INT AUTO_INCREMENT PRIMARY KEY, 
                    register_time TEXT(20),
                    register_status TEXT(20),
                    info_firstname text(20),
                    info_lastname text(20),
                    info_age int(20),
                    info_email text(20),
                    info_phonenumber text(20),
                    info_password text(20)
                    );";
}
$result = mysqli_query($conn, $query);
// checks if the execution was successful

if ($result) {

$sql_table = 'logins';
		$query = "INSERT into $sql_table (
			register_id, 
			register_time, 
			register_status,
			info_firstname,
			info_lastname,
			info_age,
			info_email,
			info_phonenumber,
			info_password)
		values ('register_id',
		        'register_time', 
		        'register_status',
		        'info_firstname',
		        'info_lastname',
		        'info_age',
		        'info_email',
		        'info_phonenumber',
		        'info_password'
		         );";
 $insert_result = mysqli_query ($conn, $query);
 if ($insert_result) {   //   insert successfully 
                $db_Msg="<p>New user has been registered into the database.</p>"
                        . "<table class='loginTable'><tr><th>Item</th><th>Value</th></tr>"
                        . "<tr><th>Register ID:</th><td>" . mysqli_insert_id($conn) . "</td></tr>"
                        . "<tr><th>First Name:</th><td>$firstname</td></tr>"
                        . "<tr><th>Last Name:</th><td>$lastname</td></tr>"
                        . "<tr><th>Age:</th><td>$age</td></tr>"
                        . "<tr><th>Email:</th><td>$email</td></tr>"
                        . "<tr><th>Phone number:</th><td>$phonenumber</td></tr>"
                        . "<tr><th>Register time:</th><td>$register_time</td></tr>"
                        . "<tr><th>register status:</th><td>$register_status</td></tr>"
                        . "</table>";  // you can display more information 
                        } 
    else {
                $db_Msg= "<p>Insert  unsuccessful.</p>";
    }
}

else //if not succes, display error
{
$db_Msg= "<p>Create table operation unsuccessful.</p>";
    // echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";
} 

$_SESSION['db_Msg'] = $db_Msg;
header("location:register_complete.php");
    //redirect to completed register page 
// close the database connection
mysqli_close($conn);

// }
?>