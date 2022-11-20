<?php
   // connection for live server (000webhost)
   $host = "localhost";
   $user = "id19669885_go2gro";
   $pwd = "SWE20001_g72022";
   $sql_db = "id19669885_go2gro_db";
 $link = mysqli_connect("localhost","id19669885_go2gro","SWE20001_g72022","id19669885_go2gro_db");
    if($link === false){
    die("ERROR: Could not connect. " 
                . mysqli_connect_error());
    }
?>