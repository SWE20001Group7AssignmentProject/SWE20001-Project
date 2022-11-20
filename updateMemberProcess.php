 <?php 
 
if (isset($_POST['id']) && isset($_POST['status'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['id']);

    $status = validate($_POST['status']);
    
    
    if (empty($uname)) {

    echo '<script type ="text/JavaScript">';
    echo 'alert("ID is required")';
    echo '</script>';
    echo '<script type ="text/JavaScript">';
    echo 'javascript:history.go(-1)';
    echo '</script>';
        exit();

    }else if(empty($status)){

        echo '<script type ="text/JavaScript">';  
        echo 'alert("Status Change is required")';
        echo '</script>'; 
        echo '<script type ="text/JavaScript">';
        echo 'javascript:history.go(-1)';
        echo '</script>';
        exit();

    }else{
        
    if ($status == 'COMPLETE' or $status == 'PENDING'){
    
    include 'db_conn.php';
    $link = mysqli_connect("localhost","id19669885_go2gro","SWE20001_g72022","id19669885_go2gro_db");
    if($link === false){
    die("ERROR: Could not connect. " 
                . mysqli_connect_error());
}
    
    $sql = "UPDATE logins SET register_status = '$status' WHERE register_id = '$uname'";
        if(mysqli_query($link, $sql)){
    echo "Record was updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " 
                            . mysqli_error($link);
} 
mysqli_close($link);
        echo '<script type ="text/JavaScript">';
                echo 'alert("Status Successfully Changed. Redirecting to Login Page.")';
                echo '</script>';
                echo '<script type ="text/JavaScript">';
                echo 'window.location.href = "main_page_manager.php"';
                echo '</script>';
        
        }else{
        
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Incorrect Email or Status Credential.")';
        echo '</script>'; 
        echo '<script type ="text/JavaScript">';
        echo 'javascript:history.go(-1)';
        echo '</script>';

            exit();

        }
    }
 }