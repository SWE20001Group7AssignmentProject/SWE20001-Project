<!doctype html>

<head> 

<title> Add Sales Record  </title>

<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

<h1> Add Sales Record </h1>

<form action="recordprocess.php" method = "post" id="regform" novalidate="novalidate">
  <fieldset id="add_records">
    <legend>Record Details</legend>
      <p><label>Product ID:</label>
          <input type="text" name="product_id" id="product_id" size="6" >
          
       </p>
      <p><label>Product:</label>
          <input type="text" name="product" id="product" size="30"  >
       
      </p>
        <p><label>Member:</label>
          <input type="text" name="username" id="username" size="40"  >
       
       </p>
         <p><label>Date:</label>
          <input type="date" name="date" id="date" size="10"  >
       
       </p>
        <p><label>Quantity:</label>
          <input type="text" name="quantity" id="quantity" size="2"  >
         
       </p>
       <input type="submit" id="submitButton" name="submitButton" />
      <input type= "reset" value="Reset Form"/>
     
  </fieldset>
</form>
 <form method="POST" action="main_page_manager.php"> 
        <button type="submit" class="btn btn-primary mb-3">Back to Main Menu</button>
    </form>
</body>

</html>