<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql = "CREATE view IC(Iid, Iname, ILOC_X, ILOC_Y,HighId) as select Code,IJNAME,LOC_X,LOC_Y,Highid1 from ICJC where IJNAME like '%IC'";
if($conn->query($sql) === TRUE){
	echo "View users created successfully";
	
}else{
	echo "Error creating table: ";
	echo "<br/>";
	echo $conn->error;
}

$conn->close();
?>