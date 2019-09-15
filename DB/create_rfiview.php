<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql = "CREATE view rfi(rloc_x,rloc_y,rname,rid,menuname,price,hidno, imgid) as select r.rloc_x,r.rloc_y,r.rname,r.rid,f.menuname,f.price,r.hidno, f.imageid from rest_stop as r, food as f where r.rid=f.Areacode ";
if($conn->query($sql) === TRUE){
	echo "View users created successfully";
	
}else{
	echo "Error creating table: ";
	echo "<br/>";
	echo $conn->error;
}

$conn->close();
?>