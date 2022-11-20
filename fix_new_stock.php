<?php
session_start();
   if (!isset($_SESSION['info_firstname'])) 
   {// not from process_order.php, redirection
        header("location:login_page.php");
        echo "PLease log in again";
        exit();
    }

       
        if (isset($_SESSION["stock_id"]))    // first name
                $stock_id=$_SESSION["stock_id"];
        else 
                $stock_id="";
         
        if (isset($_SESSION["stock_name"]))    // last name
                $stock_name=$_SESSION["stock_name"];
        else 
                $stock_name="";

        if (isset($_SESSION["add_date"])) //email
                $date=$_SESSION["add_date"];
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Go2Grocer</title>
</head>
<body>

     <h1> Fix New Stock </h1>

<form action="add_stock_process.php" method = "post" id="regform" novalidate="novalidate">
  <fieldset id="add_records">
    <legend>New Stock Details</legend>
      <p><label>Stock ID:</label>
          <input type="text" name="stock_id" id="stock_id" size="6" value = "<?php echo $stock_id; ?>" >
          
       </p>
      <p><label>Stock Name:</label>
          <input type="text" name="stock_name" id="stock_name" size="30" value = "<?php echo $stock_name; ?>" >
       
      </p>
         <p><label>Add Date:</label>
          <input type="date" name="add_date" id="add_date" size="10" value = "<?php echo $date; ?>" >
       
       </p>
        <p><label>Stock Quantity:</label>
          <input type="text" name="quantity" id="quantity" size="2" value = "<?php echo $quantity; ?>" >
         
       </p>
       <input type="submit" id="submitButton" name="submitButton" />
      <input type= "reset" value="Reset Form"/>
     
  </fieldset>
</form>
<input type="button" name="return" onclick="location='stock_manager.php'" value="Back">
<?php print_r($_SESSION['err_Msg']);
        ?>
</body>
</html>