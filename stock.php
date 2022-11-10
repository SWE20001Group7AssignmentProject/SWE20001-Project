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
    <title>Go2Grocer</title>
</head>
<body>
    <h1>Stock Count</h1>
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
                echo "<table class='stockTable'>";
                echo "<tr>\n"
                . "<th>Stock ID</th>\n"
                . "<th>Stock Name</th>\n"
                . "<th>Last Restock Date</th>\n"
                . "<th>Stock Count</th>\n"
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
<form method="POST" action="main_page.php"> 
        <button type="submit" class="btn btn-primary mb-3">Back to Main Menu</button>
    </form>
    </fieldset>
</body>
</html>
