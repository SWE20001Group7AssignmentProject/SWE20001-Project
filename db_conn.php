<?php

$host = "localhost";
   $user = "id19669885_go2gro";
   $pwd = "SWE20001_g72022";
   $sql_db = "id19669885_go2gro_db";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {

    echo "Connection failed!";

}