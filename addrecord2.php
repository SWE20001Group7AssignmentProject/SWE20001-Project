<?php  
 session_start();

        // **********************   from process_order.php
        // display error message  
        if (isset($_SESSION["err_Msg"]))    // first name
                $err_Msg=$_SESSION["err_Msg"];
        else 
                $err_Msg="";
        // get values from session
       
        if (isset($_SESSION["product_id"]))    // first name
                $product_id=$_SESSION["product_id"];
        else 
                $product_id="";
         
        if (isset($_SESSION["product"]))    // last name
                $product=$_SESSION["product"];
        else 
                $product="";

        if (isset($_SESSION["fullname"])) //email
                $fullname=$_SESSION["fullname"];
        else 
                $fullname="";

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

<title> Add Sales Record / Receipt </title>

<link rel = "stylesheet" href = "style.css" type="text/css">

</head>

<body>

<h1> Add Sales Record / Receipt </h1>

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
          <input type="text" name="fullname" id="fullname" size="40" value="<?php echo $fullname; ?>" >
       
       </p>
         <p><label>Date:</label>
          <input type="date" name="date" id="date" size="10" value="<?php echo $date; ?>" >
       
       </p>
        <p><label>Quantity:</label>
          <input type="text" name="quantity" id="quantity" size="2" value="<?php echo $quantity; ?>" >
         
       </p>
       <input type="submit" id="submitButton" name="submitButton"value="Add Sales Records" />
      <input type= "reset" value="Reset Form"/>
      <?php echo $err_Msg; ?>
  </fieldset>
</form>

</body>

</html>