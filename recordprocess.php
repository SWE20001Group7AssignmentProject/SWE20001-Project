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
}

$product =sanitise_input($_POST["product"]);
        if ($product=="") {
         $err_Msg .= "<p>Please enter the product name.</p>\n";
        }
        else if (!preg_match("/^[a-zA-Z\s]{2,25}$/",$product)) {
         $err_Msg .= "<p>Last name can only contain max 25 alpha characters.</p>\n";
        }

 $fullname =sanitise_input($_POST["fullname"]);       
        if ($fullname=="") {
         $err_Msg .= "<p>Please enter the name of purchaser.</p>\n";
        }
        else if (!preg_match("/^[a-zA-Z\s]{2,40}$/",$fullname)) {
         $err_Msg .= "<p>Name can only contain max 40 alpha characters.</p>\n";
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

    $_SESSION['product_id'] = $product_id;
    $_SESSION['product'] = $product;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['date'] = $date;
    $_SESSION['quantity'] = $quantity;
 if ($err_Msg !=""){
 
    
    $_SESSION['err_Msg'] = $err_Msg;  

header("location:addrecord2.php"); //pass the error to fix_order
exit();
}

$conn = @mysqli_connect($host,
$user,
$pwd,
$sql_db
);

$db_Msg="";

if (!$conn) {
// Displays an error message
$db_Msg= "<p>Unable to connect to database.</p>"; // not in production script
} else {
    $query = "CREATE TABLE IF NOT EXISTS salerecords (
                    sale_id INT AUTO_INCREMENT PRIMARY KEY, 
                    sale_product_id TEXT(6) NOT NULL,
                    sale_product TEXT(25) NOT NULL,
                    sale_member_name text(40) NOT NULL,
                    sale_date text(10) NOT NULL,
                    sale_quantity int(2) NOT NULL
                    );";

$result = mysqli_query($conn, $query);
// checks if the execution was successful

if ($result) {

$sale_record = 'salerecords';
        $query = "INSERT into $sale_record ( sale_product_id, sale_product, sale_member_name, sale_date, sale_quantity)
        values ('$product_id', '$product', '$fullname', '$date', '$quantity');";


 $insert_result = mysqli_query ($conn, $query);
 if ($insert_result) {   //   insert successfully 
                $db_Msg="<p>New sales record has been registered into the database.</p>"
                        . "<table class='saleTable'><tr><th>Item</th><th>Value</th></tr>"
                        . "<tr><th>Register ID:</th><td>" . mysqli_insert_id($conn) . "</td></tr>"
                        . "<tr><th>Product ID:</th><td>$product_id</td></tr>"
                        . "<tr><th>Product:</th><td>$product</td></tr>"
                        . "<tr><th>Member Name:</th><td>$fullname</td></tr>"
                        . "<tr><th>Date:</th><td>$date</td></tr>"
                        . "<tr><th>Quantity:</th><td>$quantity</td></tr>"
                        . "</table>";  // you can display more information 
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










