<?php
// Database configuration
$host = "localhost";
$user = "id19669885_go2gro"; // $username = "id19669885_go2gro"; <-- username in the web application
$pwd = "SWE20001_g72022";
$sql_db = "id19669885_go2gro_db"; // This variable can be of any database 

// Connect to the database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// Get all of the aable names from the database
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

$sqlScript = "";
foreach ($tables as $table) {    

    // Create designated table structures
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $sqlScript .= "\n\n" . $row[1] . ";\n\n";
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $columnCount = mysqli_num_fields($result);  

    // Establish data dumping for each table
    for ($i = 0; $i < $columnCount; $i ++) {
        while ($row = mysqli_fetch_row($result)) {
            $sqlScript .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $columnCount; $j ++) {
                $row[$j] = $row[$j];
                
                if (isset($row[$j])) {
                    $sqlScript .= '"' . $row[$j] . '"';
                } else {
                    $sqlScript .= '""';
                }
                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }
            }
            $sqlScript .= ");\n";
        }
    }
    $sqlScript .= "\n"; 
}

if(!empty($sqlScript))
{
    // Save the dumped data to an SQL file
    $t = time();
    $sqlbackup = $databasename . 'backup_' . date("d-m-y",$t) . '.sql';
    $fileHandler = fopen($sqlbackup, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler); 

    // Download the SQL file to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($sqlbackup));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($sqlbackup));
    ob_clean();
    flush();
    readfile($sqlbackup);
    exec('rm ' . $sqlbackup); 
}

?>
