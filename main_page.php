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
        <h1><?php echo "Welcome, " . $_SESSION['info_firstname']; ?></h1>

        <form action="main_page.php" method="post">
        <fieldset class="enquire_form">
            <h2>Search Sales Record by:</h2>
            <!-- search by user firstname and lastname -->
            <p><label>Username: <input type="text" name="username" ></label></p>     



    <!--    search by particular product -->
        <p><label>Stock ID: </label>
            <input type="text" name="stock_id" id="stock_id" size="6">
        </p> 

        <!-- sorting the data by date -->
        <p><label >Date Search: </label>
             <input type="date" name="date_of_record" id="date_of_record" >
           </p>  
                                
 <p>Sort by quantity:
             <input type="radio" name="quantity" value="ascending">
             <label >Ascending</label>
                                
             <input type="radio" name="quantity" value="descending" checked="" />
             <label >Descending</label>                         
         </p>
        <!--  find all the pending order in the database -->
        <input class="button" type="submit" value="Search" >
        </fieldset>
    </form>
<fieldset>
<?php 
   
    
        require_once('settings.php');       //get connection information to database

            $conn = mysqli_connect($host,$user,$pwd,$sql_db);  //connect to database
            if (!isset($_POST["username"])&&!isset($_POST["stock_id"])&&!isset($_POST["date_of_record"])&&!isset($_POST["quantity"]))
            {
            $query = "SELECT * FROM salerecords; ";
            }
        else
        {
        $username=sanitise_input($_POST["username"]);
        $stock_id=sanitise_input($_POST["stock_id"]);
        $quantity= sanitise_input($_POST["quantity"]);
        $date_of_record=sanitise_input($_POST["date_of_record"]);

        $input ="";

        if ($username != "") {      
                $input .= "sale_member_username LIKE '%$username%'";
        }
        if ($stock_id != ""){
                if ($input != "")
                    $input .= "and sale_product_id LIKE '%$stock_id%'";
                else
                    $input .= "sale_product_id LIKE '%$stock_id%'";
            }
            if ($date_of_record != ""){
                if ($input != "")
                    $input .= "and sale_date LIKE '%$date_of_record%'";
                else
                    $input .= "sale_date LIKE '%$date_of_record%'";
            }

            if ($quantity =="ascending")
            {
            if ($input == "") {
                $query="SELECT * FROM salerecords ORDER BY sale_quantity Asc";
            }
            else{
                $query="SELECT * FROM salerecords WHERE $input ORDER BY sale_quantity Asc";
                }
            } 
            else if ($quantity =="descending")
        {
            if ($input == "") {
                $query="SELECT * FROM salerecords ORDER BY sale_quantity Desc";
            }
            else{
                $query="SELECT * FROM salerecords WHERE $input ORDER BY sale_quantity Desc";
                }
        }
        else
        {
            $query="SELECT * FROM salerecords WHERE $input";
        }
    }



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
                . "<th>Member Userame</th>\n"
                . "<th>Date Purchased</th>\n"
                . "<th>Quantity</th>\n"
                . "</tr>\n";

                while ($record) {
                    echo "<tr>\n";
                    echo "<td>{$record['sale_id']}</td>\n";
                    echo "<td>{$record['sale_product_id']}</td>\n";
                    echo "<td>{$record['sale_product']}</td>\n";
                    echo "<td>{$record['sale_member_username']}</td>\n";
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
            echo "<p>Sales Record table doesn't exist or select operation unsuccessful.</p>";
        }
        mysqli_close ($conn);   // Close the database connection
    } else {
        echo "<p>Unable to connect to the database.</p>";
    }
    ?>
<p><form method="POST" action="addrecord1.php"> 
        <button type="submit" class="btn btn-primary mb-3">Add sale records</button>
    </form>
    <form method="POST" action="select_sale_id.php"> 
        <button type="submit" class="btn btn-primary mb-3">Edit sale records</button>
    </form>
    <form method="POST" action="stock.php"> 
        <button type="submit" class="btn btn-primary mb-3">View Stock</button>
    </form>
</p>
</fieldset>
</body>
</html>