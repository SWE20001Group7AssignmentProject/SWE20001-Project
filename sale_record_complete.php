<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="description" content="Go2Gro Project" />
        <meta name="keywords"    content="Assignment, Swinburne, class" />
        <meta name="author"      content="Ryan Term Zhi Jie" /> 
        <link rel="stylesheet" type="text/css" href="css/table.css">
        <title>Add Sales Records Complete</title>
  
</head>
<body>  
<fieldset>
<?php 
        echo "<h2>Add sales record complete</h2>";
        if (!isset($_SESSION["db_Msg"])) {// not from process_order.php, redirection
                header("location:addrecord2.php");
                exit();
        }
        else { // from process_order.php, display receipt
                echo $_SESSION["db_Msg"];
        }        ?>
</fieldset>
<input type="button" name="return_addrecord" onclick="location='addrecord2.php'" value="Return">
</body>
</html>    