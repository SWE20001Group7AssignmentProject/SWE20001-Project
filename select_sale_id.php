<?php
session_start();
   if (!isset($_SESSION['info_firstname'])) 
   {// not from process_order.php, redirection
        header("location:login_page.php");
        echo "PLease log in again";
        exit();
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <title>Go2Grocer</title>
</head>
<body>
    <form action="edit_sales.php" method="post">
        <fieldset class="enquire_form">
             <p><label>Record ID: <input type="text" id= "record_id" name="record_id" maxlength="6" ></label></p>

             <input class="button" type="submit" value="Search" >
         </fieldset>
     </form>
     <form method="POST" action="main_page.php"> 
        <button type="submit" class="btn btn-primary mb-3">Back</button>
    </form>
</body>
</html>

