<?php
session_start();
if(!isset($_SESSION['err_Msg'])){
$_SESSION['err_Msg']="";
}
if(!isset($_SESSION['db_Msg'])){
$_SESSION['db_Msg']="";
}
?>
<?php
 require_once ("settings.php");

 function sanitise_input($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
      }
$conn = @mysqli_connect($host,
$user,
$pwd,
$sql_db
);

if (!isset($_POST["submitButton"])) {
        header("location:addrecord2.php");
        exit();
    }

    $err_Msg = "";

    if (!isset($_POST["product_id"])){
   header("location:addrecord2.php");
        exit();
} else {
$product_id =sanitise_input($_POST["product_id"]);
        if ($product_id=="") {
         $err_Msg .= "<p>Please enter the product ID.</p>\n";
        }
        else if (!preg_match("/^[A-Z]{3}[\d]{3}$/",$product_id)) {
         $err_Msg .= "<p>Product ID must only have 3 capital letters and 3 numbers.</p>\n";
        }
        else 
        {
            $sql_check_details = "SELECT * FROM stock WHERE stock_id = '$product_id'";
            $result = @mysqli_query($conn, $sql_check_details);
            if (!@mysqli_num_rows($result)) {
                        $err_Msg .= "<p>Product does not exist.</p>";
                    }
        }
}

$product =sanitise_input($_POST["product"]);
        if ($product=="") {
         $err_Msg .= "<p>Please enter the product name.</p>\n";
        }
        else if (!preg_match("/^[a-zA-Z\s]{2,25}$/",$product)) {
         $err_Msg .= "<p>Last name can only contain max 25 alpha characters.</p>\n";
        }

 $username =sanitise_input($_POST["username"]);       
        if ($username=="") {
         $err_Msg .= "<p>Please enter the name of purchaser.</p>\n";
        }
        else
        {
                    $sql_check_details = "SELECT * FROM users WHERE username = '$username'";
                    $result = @mysqli_query($conn, $sql_check_details);
                    if (!@mysqli_num_rows($result)) {
                        $err_Msg .= "<p>Username of purchaser is incorrect or does not exist.</p>";
                    }
        }
$date = sanitise_input($_POST["date"]);
        if ($date=="") {
            $err_Msg .= "<p>Please enter your date of sale.</p>";
        }

$quantity =sanitise_input($_POST["quantity"]);
         if ($quantity == "") {
         $err_Msg .= "<p>Please enter the product quantity sold.</p>\n";
         } else if (!is_numeric($quantity)) {
            $err_Msg .= "<p>Input is not numeric.</p>\n";
        }
        else if ($quantity < 1 || $quantity > 10){
         $err_Msg .= "<p class='align-center'>Quantity sold must only be within 1 to 10.</p>\n";
       }
       else 
        {
            $sql_check_details = "SELECT stock_quantity FROM stock WHERE stock_id = '$product_id'";
            $result = @mysqli_query($conn, $sql_check_details);
            if (@mysqli_num_rows($result)) {
                        $record = mysqli_fetch_assoc ($result);
                        if ($record['stock_quantity'] < 0)
                        {
                            $err_Msg .= "There is no stock left. Please restock first";
                        }
                        else if($record['stock_quantity'] < $quantity)
                        {
                            $err_Msg .= "Quantity in stock is less than quantity to be denoted";
                        }
                    }
        }   

    $_SESSION['product_id'] = $product_id;
    $_SESSION['product'] = $product;
    $_SESSION['username'] = $username;
    $_SESSION['date'] = $date;
    $_SESSION['quantity'] = $quantity;
 if ($err_Msg !=""){
 
    
    $_SESSION['err_Msg'] = $err_Msg;  

header("location:addrecord2.php"); //pass the error to fix_order
exit();
}



$db_Msg="";

$updated_stock = $record['stock_quantity']-$quantity;
if (!$conn) {
// Displays an error message
$db_Msg= "<p>Unable to connect to database.</p>"; // not in production script
} else {
    $query = "CREATE TABLE IF NOT EXISTS salerecords (
                    sale_id INT AUTO_INCREMENT PRIMARY KEY, 
                    sale_product_id CHAR(6) NOT NULL,
                    sale_product varchar(100) NOT NULL,
                    sale_member_username text(40) NOT NULL,
                    sale_date text(10) NOT NULL,
                    sale_quantity int(2) NOT NULL
                    );";

$result = mysqli_query($conn, $query);
// checks if the execution was successful

if ($result) {

$sale_record = 'salerecords';
        $query = "INSERT into $sale_record ( sale_product_id, sale_product, sale_member_username, sale_date, sale_quantity)
        values ('$product_id', '$product', '$username', '$date', '$quantity');";


 $insert_result = mysqli_query ($conn, $query);
 if ($insert_result) {   //   insert successfully 

 $db_Msg="<p>New sales record has been registered into the database.</p>"
                        . "<table class='saleTable'><tr><th>Item</th><th>Value</th></tr>"
                        . "<tr><th>Register ID:</th><td>" . mysqli_insert_id($conn) . "</td></tr>"
                        . "<tr><th>Product ID:</th><td>$product_id</td></tr>"
                        . "<tr><th>Product:</th><td>$product</td></tr>"
                        . "<tr><th>Member Username:</th><td>$username</td></tr>"
                        . "<tr><th>Date:</th><td>$date</td></tr>"
                        . "<tr><th>Quantity:</th><td>$quantity</td></tr>"
                        . "</table>";  // you can display more information 
    
    $update_query = "UPDATE stock SET stock_quantity = '$updated_stock', last_restock_date = '$date' where stock_id = '$product_id'";
    $update_result = mysqli_query($conn, $update_query);

    if($update_result)
    {}
                        else 
                        {
                            $db_Msg.= "<p>Update stock unsuccessful.</p>";
                        }
    } 
    else {
                $db_Msg= "<p>Insert  unsuccessful.</p>";
    }
}

else //if not succes, display error
{
$db_Msg= "<p>Create table operation unsuccessful.</p>";
    // echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";
} 

$_SESSION['db_Msg'] = $db_Msg;
header("location:sale_record_complete.php");
    //redirect to completed register page 
// close the database connection
mysqli_close($conn);

}
?>










