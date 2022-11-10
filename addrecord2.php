<?php  
 session_start();
if (!isset($_SESSION['err_Msg'])) 
{
header("location:addrecord1.php");
exit();// terminiate 
}
        // **********************   from process_order.php
        // display error message  
         // display error message  
        
       
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
 
<!doctype html>

<head> 

<title> Fix Sales Records </title>

<link rel = "stylesheet" href = "style.css" type="text/css">

</head>

<body>

<h1> Fix Sales Record </h1>

<form action="recordprocess.php" method = "post" id="regform" novalidate="novalidate">
  <fieldset id="add_records">
    <legend>Record Details</legend>
      <p><label>Product ID:</label>
          <input type="text" name="product_id" id="product_id" size="6" value="<?php echo $product_id; ?>" >
          
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
       <input type="submit" id="submitButton" name="submitButton"value="Add Sales Records" />
      <input type= "reset" value="Reset Form"/>

      <?php print_r($_SESSION['err_Msg']);
        // get values from session ?>
  </fieldset>
</form>
 <form method="POST" action="main_page.php"> 
        <button type="submit" class="btn btn-primary mb-3">Back to Main Menu</button>
    </form>

</body>

</html>