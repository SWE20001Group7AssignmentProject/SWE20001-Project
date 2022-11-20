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
        <h1><?php echo "Welcome, " . $_SESSION['info_firstname']; ?></h1>

        <form action="main_page_manager.php" method="post">
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

    <form action="edit_sales.php" method="post">
        <p>
             <label>Sale Record ID: <input type="text" id= "record_id" name="record_id" maxlength="6" ></label>
             <input class="button" type="submit" value="Search" >
             </p>
     </form>

     <p>
    <input type="button" name="go_to_add_record" onclick="location='addrecord1.php'" value="Add sale records">
    <input type="button" name="go_to_view_stock" onclick="location='stock_manager.php'" value="View Stock">
    <input type="button" name="go_to_update_member" onclick="location='updateMember.php'" value="Change User Status">
    <input type="button" name="go_to_backup_database" onclick="location='backuppage.php'" value="Backup Database">
    <input type="button" name="download_csv" onclick="location='gensalespage.php'" value="Generate CSV">
    </p>
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
                echo "<div class=\"search-table-outer\">";
                echo "<table class='managerTable'>";
                echo "<tr>\n"
                . "<th scope=\"col\">Sale ID</th>\n"
                . "<th scope=\"col\">Product ID</th>\n"
                . "<th scope=\"col\">Product</th>\n"
                . "<th scope=\"col\">Member Username</th>\n"
                . "<th scope=\"col\">Date Purchased</th>\n"
                . "<th scope=\"col\">Quantity</th>\n"
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
                echo "</div>";
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

    

</fieldset>
</body>
</html>