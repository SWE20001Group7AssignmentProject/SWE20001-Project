<?php 
// Database configuration
$host = "localhost";
$username = "root"; // $username = "id19669885_go2gro"; <-- username in the web application
$password = "SWE20001_g72022";
$databasename = "id19669885_go2gro_db"; // This variable can be of any database

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $databasename);

$query = "SELECT * FROM salerecords";
$result = mysqli_query($conn, $query);

$num_column = mysqli_num_fields($result);		

$csv_header = '';
for($i=0;$i<$num_column;$i++) {
    $csv_header .= '"' . mysqli_fetch_field_direct($result,$i)->name . '",';
}	
$csv_header .= "\n";

$csv_row ='';
while($row = mysqli_fetch_row($result)) {
	for($i=0;$i<$num_column;$i++) {
		$csv_row .= '"' . $row[$i] . '",';
	}
	$csv_row .= "\n";
}	

// Save the dumped data to a CSV file
$t = time();
$csvfile = 'salerecordstable_'.date("d-m-y",$t) . '.csv';

/* Download as CSV File */
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.basename($csvfile));
echo $csv_header . $csv_row;
exit;
?>
