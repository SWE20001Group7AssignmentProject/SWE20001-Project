<?php 

session_start(); 

include "settings.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['email']);

    $pass = validate($_POST['password']);
    
    $verification = 'COMPLETE';
    
    $membertype = 'MANAGER';
    
    $membertype2 = 'EMPLOYEE';
    
    if (empty($uname)) {

    echo '<script type ="text/JavaScript">';
    echo 'alert("Email is required")';
    echo '</script>';
    echo '<script type ="text/JavaScript">';
    echo 'javascript:history.go(-1)';
    echo '</script>';
        exit();

    }else if(empty($pass)){

        echo '<script type ="text/JavaScript">';  
        echo 'alert("Password is required")';
        echo '</script>'; 
        echo '<script type ="text/JavaScript">';
        echo 'javascript:history.go(-1)';
        echo '</script>';
        exit();

    }else{
        
        $sql = "SELECT * FROM logins WHERE info_email='$uname' AND info_password='$pass'";

        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            
            if ($row['info_email'] === $uname && $row['info_password'] === $pass && $row['register_status'] === $verification && $row['member_status'] === $membertype) {
                
                $_SESSION['info_email'] = $row['info_email'];

                $_SESSION['info_firstname'] = $row['info_firstname'];

                $_SESSION['register_id'] = $row['register_id'];
                
                echo '<script type ="text/JavaScript">';
                echo 'alert("Login Complete.")';
                echo '</script>';
                echo '<script type ="text/JavaScript">';
                echo 'window.location.href = "main_page_manager.php"';
                echo '</script>';
                
                } else if ($row['info_email'] === $uname && $row['info_password'] === $pass && $row['member_status'] === $membertype2 && $row['register_status'] === $verification){
                
                    $_SESSION['info_email'] = $row['info_email'];

                    $_SESSION['info_firstname'] = $row['info_firstname'];

                    $_SESSION['register_id'] = $row['register_id'];
                    echo '<script type ="text/JavaScript">';
                    echo 'alert("Login Complete.")';
                    echo '</script>';
                    echo '<script type ="text/JavaScript">';
                    echo 'window.location.href = "main_page.php"';
                    echo '</script>'; 

            }else if ($row["register_status"] === "PENDING"){

                echo '<script type ="text/JavaScript">';  
                echo 'alert("This user is waiting for approval. Please login again after approval.")';
                echo '</script>'; 
                echo '<script type ="text/JavaScript">';
                echo 'javascript:history.go(-1)';
                echo '</script>';

                exit();

            }

        }
    }
        }else{
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Incorrect Email or Password.")';
        echo '</script>'; 
        echo '<script type ="text/JavaScript">';
        echo 'javascript:history.go(-1)';
        echo '</script>';

            exit();

        }