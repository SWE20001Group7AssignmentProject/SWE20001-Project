<!doctype html>

<head> 

<title> Add New Stock  </title>

<link rel="stylesheet" type="text/css" href="css/style.css">


</head>

<body>

<h1> Add New Stock </h1>

<form action="add_stock_process.php" method = "post" id="regform" novalidate="novalidate">
  <fieldset id="add_records">
    <legend>New Stock Details</legend>
      <p><label>Stock ID:</label>
          <input type="text" name="stock_id" id="stock_id" size="6" >
          
       </p>
      <p><label>Stock Name:</label>
          <input type="text" name="stock_name" id="stock_name" size="30"  >
       
      </p>
         <p><label>Add Date:</label>
          <input type="date" name="add_date" id="add_date" size="10"  >
       
       </p>
        <p><label>Stock Quantity:</label>
          <input type="text" name="quantity" id="quantity" size="2"  >
         
       </p>
       <input type="submit" id="submitButton" name="submitButton" />
      <input type= "reset" value="Reset Form"/>
     
  </fieldset>
</form>
 <input type="button" name="return" onclick="location='stock_manager.php'" value="Back">
</body>

</html>