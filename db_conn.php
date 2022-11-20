<?php
$host = "localhost";
$user = "id19669885_go2gro";
$pwd = "SWE20001_g72022";
$sql_db = "id19669885_go2gro_db";
$link = mysqli_connect($host, $user, $pwd, $sql_db);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>