<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql = "CREATE view JC(Jid, Jname, JLOC_X, JLOC_Y,HighId1,HighId2) as select * from ICJC where IJNAME like '%JCT'";
if($conn->query($sql) === TRUE){
	echo "View users created successfully";
	
}else{
	echo "Error creating table: ";
	echo "<br/>";
	echo $conn->error;
}

$conn->close();
?>