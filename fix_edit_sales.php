<?php
session_start();
   if (!isset($_SESSION['info_firstname'])) 
   {// not from process_order.php, redirection
        header("location:login_page.php");
        echo "PLease log in again";
        exit();
    }

    print_r($_SESSION['err_Msg']);
        // get values from session
       
        if (isset($_SESSION["product_id"]))    // first name
                $product_id=$_SESSION["product_id"];
        else 
                $product_id="";
         
        if (isset($_SESSION["product"]))    // last name
                $product=$_SESSION["product"];
        else 
                $product="";

        if (isset($_SESSION["username"])) //email
                $username=$_SESSION["username"];
        else 
                $username="";

        if (isset($_SESSION["date"])) //email
                $date=$_SESSION["date"];
        else 
                $date="";

        if (isset($_SESSION["quantity"])) //phone
                $quantity=$_SESSION["quantity"];
        else 
                $quantity="";
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

     <form action="edit_sales_process.php" method = "post" >
  <fieldset id="add_records">
    <legend>Edit Record Details</legend>
      <p><label>Product ID:</label>
          <input type="text" name="product_id" id="product_id" size="6" value="<?php echo $product_id; ?>">
          
       </p>
      <p><label>Product:</label>
          <input type="text" name="product" id="product" size="30" value="<?php echo $product; ?>" >
       
      </p>
        <p><label>Member:</label>
          <input type="text" name="username" id="username" size="40" value="<?php echo $username; ?>" >
       
       </p>
         <p><label>Date:</label>
          <input type="date" name="date" id="date" size="10" value="<?php echo $date; ?>" >
       
       </p>
        <p><label>Quantity:</label>
          <input type="text" name="quantity" id="quantity" size="2" value="<?php echo $quantity; ?>" >
         
       </p>
       <input type="submit" id="submitButton" name="submitButton" />
      <input type= "reset" value="Reset Form"/>
      <form method="POST" action="select_sale_id.php"> 
        <button type="submit" class="btn btn-primary mb-3">Back</button>
    </form>
  </fieldset>
</form>

<?php

?>