<?php
session_start();
if(!isset($_SESSION['err_Msg'])){
$_SESSION['err_Msg']="";
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
        header("location:fix_new_stock.php");
        exit();
    }

    $err_Msg = "";

    if (!isset($_POST["stock_id"])){
   header("location:fix_new_stock.php");
        exit();
} else {
$stock_id =sanitise_input($_POST["stock_id"]);
        if ($stock_id=="") {
         $err_Msg .= "<p>Please enter the product ID.</p>\n";
        }
        else if (!preg_match("/^[A-Z]{3}[\d]{3}$/",$stock_id)) {
         $err_Msg .= "<p>Product ID must only have 3 capital letters and 3 numbers.</p>\n";
        }
}

$stock_name =sanitise_input($_POST["stock_name"]);
        if ($stock_name=="") {
         $err_Msg .= "<p>Please enter the stock name.</p>\n";
        }
        else if (!preg_match("/^[a-zA-Z\s\d]{2,100}$/",$stock_name)) {
         $err_Msg .= "<p>Stock name can only contain max 100 alpha characters and digits.</p>\n";
        }

 
$add_date = sanitise_input($_POST["add_date"]);
        if ($add_date=="") {
            $err_Msg .= "<p>Please enter your date of adding new stock.</p>";
        }

$quantity =sanitise_input($_POST["quantity"]);
         if ($quantity == "") {
         $err_Msg .= "<p>Please enter the stock quantity.</p>\n";
         } else if (!is_numeric($quantity)) {
            $err_Msg .= "<p>Input is not numeric.</p>\n";
        }
        else if ($quantity < 10 ){
         $err_Msg .= "<p class='align-center'>Quantity in stock must be at least 10.</p>\n";
       }

    $_SESSION['stock_id'] = $stock_id;
    $_SESSION['stock_name'] = $stock_name;
    $_SESSION['add_date'] = $add_date;
    $_SESSION['quantity'] = $quantity;
 if ($err_Msg !=""){
 
    
    $_SESSION['err_Msg'] = $err_Msg;  

header("location:fix_new_stock.php"); //pass the error to fix_order
exit();
}



$db_Msg="";

if (!$conn) {
// Displays an error message
                echo '<script type ="text/JavaScript">';
                echo 'alert("Unable to connect to database.")';
                echo '</script>';
} else {
    $query = "CREATE TABLE IF NOT EXISTS stock ( 
                    stock_id CHAR(6) NOT NULL,
                    stock_name varchar(100) NOT NULL,
                    last_restock_date text(10),
                    stock_quantity int(2) NOT NULL
                    );";

$result = mysqli_query($conn, $query);
// checks if the execution was successful

if ($result) {

$add_stock = 'stock';
        $query = "INSERT into $add_stock ( stock_id, stock_name, last_restock_date, stock_quantity)
        values ('$stock_id', '$stock_name', '$add_date', '$quantity');";


 $insert_result = mysqli_query ($conn, $query);
 if ($insert_result) {   //   insert successfully 
                echo '<script type ="text/JavaScript">';
                echo 'alert("Stock addition has been successful.")';
                echo '</script>';
    } 
    else {
                 echo '<script type ="text/JavaScript">';
                echo 'alert("Stock addition has been unsuccessful.")';
                echo '</script>';
    }
}

else //if not succes, display error
{
                echo '<script type ="text/JavaScript">';
                echo 'alert("Create table operation unsuccessful.")';
                echo '</script>';
} 

// close the database connection
        mysqli_close($conn);
        echo '<script type ="text/JavaScript">';
        echo 'window.location.href = "new_stock.php"';
        echo '</script>';
        exit();
}
?>