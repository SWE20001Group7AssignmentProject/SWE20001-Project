<?php
session_start();
   if (!isset($_SESSION['info_firstname'])) 
   {// not from process_order.php, redirection
        header("location:login_page.php");
        exit();
    }

    function sanitise_input($data){
        $data = trim($data);                //remove spaces
        $data = stripslashes($data);        //remove backslashes in front of quotes
        $data = htmlspecialchars($data);    //convert HTML special characters to HTML code
        return $data;
    }

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
    <h1>Go 2 Grocery Stock and Analysis</h1>
    <fieldset>
        <label>Sale-Stock Analysis</label>
<?php
require_once('settings.php');
       //get connection information to database
$conn = mysqli_connect($host,$user,$pwd,$sql_db);  //connect to database
$query = "SELECT sale_product_id, COUNT(sale_product_id) as sale_record_frequency, SUM(sale_quantity) as total_sold FROM salerecords 
GROUP BY sale_product_id ORDER BY sale_record_frequency ASC; ";

if ($conn)
{
    $result = mysqli_query( $conn, $query);
    if($result)
    {
        $analysis = mysqli_fetch_assoc($result);
        if ($analysis)
        {
            //display the table from database
                echo "<div class=\"search-table-outer\">";
                echo "<table id= \"analysis_table\" class='analysisTable'>";
                echo "<tr>\n"
                . "<th scope=\"col\">Stock ID</th>\n"
                . "<th scope=\"col\">Stock Sale Count</th>\n"
                . "<th scope=\"col\">Total Stock Sold</th>\n"
                . "</tr>\n";

                while ($analysis) {
                    echo "<tr>\n";
                    echo "<td>{$analysis['sale_product_id']}</td>\n";
                    echo "<td>{$analysis['sale_record_frequency']}</td>\n";
                    echo "<td>{$analysis['total_sold']}</td>\n";
                    echo "</tr>\n";
                    $analysis = mysqli_fetch_assoc($result);
                }
                echo "</div>";
                echo "</table>";
                mysqli_free_result ($result);   // Free resources
        }
        else
        {
            echo "<p>No sale records retrieved.</p>";
        }
    }
    else
    {
        echo "<p>No such table exists.</p>";
    }
    mysqli_close ($conn);
}   
else 
{
     echo "<p>No connection have been estabished with the database.</p>";
 } 
        ?>
    </fieldset>
    
    <fieldset>
<?php       
require_once('settings.php');       //get connection information to database
$conn = mysqli_connect($host,$user,$pwd,$sql_db);  //connect to database
$query = "SELECT * FROM stock; ";

if ($conn) { // connected
 
        $result = mysqli_query ($conn, $query);     
        if ($result) {  //   query was successfully executed
            
            $stock = mysqli_fetch_assoc ($result);
            if ($stock) {      //   record exist

                //display the table from database
                echo "<div class=\"search-table-outer\">";
                echo "<table id= \"stock_table\" class='stockTable'>";
                echo "<tr>\n"
                . "<th scope=\"col\">Stock ID</th>\n"
                . "<th scope=\"col\">Stock Name</th>\n"
                . "<th scope=\"col\">Last Restock Date</th>\n"
                . "<th scope=\"col\">Stock Count</th>\n"
                . "</tr>\n";

                while ($stock) {
                    echo "<tr>\n";
                    echo "<td>{$stock['stock_id']}</td>\n";
                    echo "<td>{$stock['stock_name']}</td>\n";
                    echo "<td>{$stock['last_restock_date']}</td>\n";
                    echo "<td>{$stock['stock_quantity']}</td>\n";
                    echo "</tr>\n";
                    $stock = mysqli_fetch_assoc($result);
                }
                echo "</div>";
                echo "</table>";
                mysqli_free_result ($result);   // Free resources
            } else {
                echo "<p>No stock records retrieved.</p>";
            }
        } else {
            echo "<p>Stock table doesn't exist.</p>";
        }
        mysqli_close ($conn);   // Close the database connection
    } else {
        echo "<p>Unable to connect to the database.</p>";
    } 
?>
        
<p>
    <input type="button" name="return_login" onclick="location='main_page.php'" value="Back to Main Menu">
</p>
    </fieldset>

   
</body>
</html>
