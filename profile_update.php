<?php
 
 session_start();
 include "db_conn.php";
 if(isset($_POST['edit']))
 {
    $id=$_SESSION['id'];
    $username=$_POST['username'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];
    $select= "select * from users where id='$id'";
    $sql = mysqli_query($link,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
    if($res === $id)
    {
   
       $update = "update users set username='$username', firstname='$fname',lastname='$lname',email='$email', mobile='$mobile', password='$password', where id='$id'";
       $sql2=mysqli_query($conn,$update);
if($sql2)
       { 
           /*Successful*/
           header('location:profile.php');
       }
       else
       {
           /*sorry your profile is not update*/
           header('location:profile_edit.php');
       }
    }
    else
    {
        /*sorry your id is not match*/
        header('location:profile_edit.php');
    }
 }
?>