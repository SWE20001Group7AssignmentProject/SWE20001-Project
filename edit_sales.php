<?php
session_start();
   if (!isset($_SESSION['info_firstname'])) 
   {// not from process_order.php, redirection
        header("location:login_page.php");
        echo "PLease log in again";
        exit();
    }
    if(!isset($_POST['record_id']))
    {
        header("location:select_sale_id");
        exit();
    }

    function sanitise_input($data){
        $data = trim($data);                //remove spaces
        $data = stripslashes($data);        //remove backslashes in front of quotes
        $data = htmlspecialchars($data);    //convert HTML special characters to HTML code
        return $data;
    }

    require_once('settings.php');       //get connection information to database

            $conn = mysqli_connect($host,$user,$pwd,$sql_db);  //connect to database
            $record_id = sanitise_input($_POST["record_id"]);
            $_SESSION['record_id'] = $record_id;

if ($record_id !="")
{
$query = "SELECT * FROM salerecords WHERE sale_id = '$record_id'";

$query_result = @mysqli_query($conn, $query);

if (@mysqli_num_rows($query_result))
{
    $edit_record = mysqli_fetch_assoc ($query_result);
    mysqli_close($conn);
}
else 
    {
        echo "<p>No such record exist.</p>";
    }
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

     <form action="edit_sales_process.php" method = "post" >
  <fieldset id="add_records">
    <legend>Record Details</legend>
      <p><label>Product ID:</label>
          <input type="text" name="product_id" id="product_id" size="6" value="<?php echo $edit_record['sale_product_id']; ?>">
          
       </p>
      <p><label>Product:</label>
          <input type="text" name="product" id="product" size="30" value="<?php echo $edit_record['sale_product']; ?>" >
       
      </p>
        <p><label>Member:</label>
          <input type="text" name="username" id="username" size="40" value="<?php echo $edit_record['sale_member_username']; ?>" >
       
       </p>
         <p><label>Date:</label>
          <input type="date" name="date" id="date" size="10" value="<?php echo $edit_record['sale_date']; ?>" >
       
       </p>
        <p><label>Quantity:</label>
          <input type="text" name="quantity" id="quantity" size="2" value="<?php echo $edit_record['sale_quantity']; ?>" >
         
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