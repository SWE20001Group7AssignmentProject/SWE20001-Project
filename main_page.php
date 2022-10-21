<?php
session_start();

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
        <h1><?php echo 'Welcome'; ?></h1>
        <fieldset>
<?php 
    function sanitise_input($data){
        $data = trim($data);                //remove spaces
        $data = stripslashes($data);        //remove backslashes in front of quotes
        $data = htmlspecialchars($data);    //convert HTML special characters to HTML code
        return $data;}
        require_once('settings.php');       //get connection information to database
            $conn = @mysqli_connect($host,$user,$pwd,$sql_db);  //connect to database

            $query = "SELECT * FROM salerecords;";

            if ($conn) { // connected
 
        $result = mysqli_query ($conn, $query);     
        if ($result) {  //   query was successfully executed
            
            $record = mysqli_fetch_assoc ($result);
            if ($record) {      //   record exist


            
                //display the table from database
                echo "<table class='managerTable'>";
                echo "<tr>\n"
                . "<th>Sale ID</th>\n"
                . "<th>Product ID</th>\n"
                . "<th>Product</th>\n"
                . "<th>Member Name</th>\n"
                . "<th>Date Purchased</th>\n"
                . "<th>Quantity</th>\n"
                . "</tr>\n";

                while ($record) {
                    echo "<tr>\n";
                    echo "<td>{$record['sale_id']}</td>\n";
                    echo "<td>{$record['sale_product_id']}</td>\n";
                    echo "<td>{$record['sale_product']}</td>\n";
                    echo "<td>{$record['sale_member_name']}</td>\n";
                    echo "<td>{$record['sale_date']}</td>\n";
                    echo "<td>{$record['sale_quantity']}</td>\n";
                    echo "</tr>\n";
                    $record = mysqli_fetch_assoc($result);
                }
                echo "</table>";
                mysqli_free_result ($result);   // Free resources
            } else {
                echo "<p>No record retrieved.</p>";
            }
        } else {
            echo "<p>Orders table doesn't exist or select operation unsuccessful.</p>";
        }
        mysqli_close ($conn);   // Close the database connection
    } else {
        echo "<p>Unable to connect to the database.</p>";
    }
    ?>

</fieldset>
</body>
</html>