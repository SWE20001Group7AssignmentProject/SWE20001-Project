<?php

//Editor Jobenjot Singh


	// connection for live server (000webhost)
   $host = "localhost";
   $user = "id19669885_go2gro";
   $pwd = "SWE20001_g72022";
   $sql_db = "id19669885_go2gro_db";
    $connect = mysqli_connect($host, $user, $pwd, $sql_db) or die("Unable to connect");
    if (isset($_POST["signup"])) {
        if (!empty($_POST["username"]) && !empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST["mobile"]) && !empty($_POST["password"])) {
            $username = $_POST['username'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email= $_POST['email'];
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if ($_POST['password'] !== $_POST['cpassword']) {
    die('Password and Confirm Password does not match');
}         
            //Write SQL query
            $query = "INSERT INTO users(username, firstname, lastname, email, mobile, password, active) values('$username', '$fname', '$lname', '$email', '$mobile', '$password', '1')";
            $result = mysqli_query($connect, $query) or die("Unable to add member's record into Registers table" );
            if ($result) {
                echo "Successfully add member's details into Registers Table";
				header('Location: dbNote.php');
			
            } else {
                echo "Form unsuccessfully submitted";
            }

        } else {
            echo "All fields required";
        }
    }
    mysqli_close($connect);

?>