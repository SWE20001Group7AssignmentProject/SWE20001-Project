<?php
session_start();
if(!isset($_SESSION['err_Msg'])){
$_SESSION['err_Msg']="";
}

if (!isset($_POST["submitButton"])) {
        header("location:main_page_manager.php");
        exit();
    }

    require_once('settings.php');  

function sanitise_input($data){
        $data = trim($data);                //remove spaces
        $data = stripslashes($data);        //remove backslashes in front of quotes
        $data = htmlspecialchars($data);    //convert HTML special characters to HTML code
        return $data;
    }

     //get connection information to database

$conn = mysqli_connect($host,$user,$pwd,$sql_db);  //connect to database

$input ="";
$err_Msg = "";
$record_id = sanitise_input($_SESSION['record_id']);

$query = "SELECT * FROM salerecords WHERE sale_id = '$record_id'";

$query_result = @mysqli_query($conn, $query);

if (@mysqli_num_rows($query_result))
{
    $edit_record = mysqli_fetch_assoc ($query_result);
}


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
            if (!@mysqli_num_rows($result)) 
            {
                $err_Msg .= "<p>Product does not exist.</p>\n";
            }
            else
            {
                if ($product_id != $edit_record['sale_product_id'])
                {
                    $input .= "sale_product_id = '$product_id'";
                }
            }
        }
    


$product =sanitise_input($_POST["product"]);

        if ($product=="") {
         $err_Msg .= "<p>Please enter the product name.</p>\n";
        }
        else if (!preg_match("/^[a-zA-Z\s\d]{2,100}$/",$product)) {
         $err_Msg .= "<p>Stock name can only contain max 100 alpha characters and digits.</p>\n";
        }
        else
        {
            if($product != $edit_record['sale_product'])
        {
            if($input == "")
            {
                $input .= "sale_product = '$product'";
            }
            else
            {
                $input .= ", sale_product = '$product'";
            }
        }
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
                        $err_Msg .= "<p>Username of purchaser is incorrect or does not exist.</p>\n";
                    }
                    else
                    {
                        if($username != $edit_record['sale_member_username'])
                            {
                            if($input == "")
                                {
                                    $input .= "sale_member_username = '$username'";
                                }
                            else
                                {
                                    $input .= ", sale_member_username = '$username'";
                                 }
                             }
                    }
        }
    

$date = sanitise_input($_POST["date"]);
        if ($date=="") {
            $err_Msg .= "<p>Please enter your date of sale.</p>\n";
        }
        else
        {
            if ($date != $edit_record['sale_date'])
        {   
            if($input == "")
            {
                $input .= "sale_date = '$date'";
            }
            else
            {
                $input .= ", sale_date = '$date'";
            }
        }
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
                        if ($record['stock_quantity'] <= 0)
                        {
                            $err_Msg .= "There is no stock left. Please restock first\n";
                        }
                        else if($record['stock_quantity'] < $quantity)
                        {
                            $err_Msg .= "Quantity in stock is less than quantity to be denoted\n";
                        }
                        else
                        {
                            if ($quantity != $edit_record['sale_quantity'])
                            {
                            $temp_og_quantity = $edit_record['sale_quantity'];
                                $updated_stock = $record['stock_quantity'] + $temp_og_quantity - $quantity;
                                if ($updated_stock >= 0)
                                {
                                if( $input == "")
                                    {
                                            $input .= "sale_quantity = '$quantity'";
                                    }
                                    else
                                    {
                                        $input .= ", sale_quantity = '$quantity'";
                                    }
                                }
                                else {    
                                    
                                    $err_Msg .= "There is no stock left to be denoted. Please wait for restock to occur.\n";
                                }
                            
                        }
                    }
                }
        } 
         
if ($err_Msg != "")
{
	$_SESSION['product_id'] = $product_id;
    $_SESSION['product'] = $product;
    $_SESSION['username'] = $username;
    $_SESSION['date'] = $date;
    $_SESSION['quantity'] = $quantity;
$_SESSION['err_Msg'] = $err_Msg;  

header("location:fix_edit_sales.php"); //pass the error to fix_order
exit();

}

if( $input !="")

        {
if ($conn)
    {
        $update_query = "UPDATE salerecords SET $input where sale_id = '$record_id'";
        $update_result = mysqli_query($conn, $update_query);
        if ($update_result)
        {
        	if ($quantity != $edit_record['sale_quantity'])
             {
            $update_query = "UPDATE stock SET stock_quantity = '$updated_stock' where stock_id = '$product_id' ";
            $update_stock_result = mysqli_query($conn, $update_query);
            if ($update_stock_result)
            {
                echo '<script type ="text/JavaScript">';
                echo 'alert("Stock and sale record update has been successful.")';
                echo '</script>';
            }
            else
            {
                 echo '<script type ="text/JavaScript">';
                echo 'alert("Stock update has been unsuccessful.")';
                echo '</script>';
            }
        }
        else
        {
				echo '<script type ="text/JavaScript">';
                echo 'alert("Sale record update has been successful.")';
                echo '</script>';
        }
        }
        else
        {
             echo '<script type ="text/JavaScript">';
                echo 'alert("Update unsuccessful.")';
                echo '</script>';
        }
    }
    else
    {
         echo '<script type ="text/JavaScript">';
                echo 'alert("Connection unsuccessful.")';
                echo '</script>';
    }
}
else
{
	echo '<script type ="text/JavaScript">';
                echo 'alert("No updates made.")';
                echo '</script>';
}


        mysqli_close($conn);
 		echo '<script type ="text/JavaScript">';
        echo 'window.location.href = "main_page_manager.php"';
        echo '</script>';
                        
        exit();

    ?>