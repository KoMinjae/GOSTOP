<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql = "CREATE view rest_inform(rloc_x,rloc_y,rname,rid,menuname,price,hidno, imgid, img) as select r.rloc_x,r.rloc_y,r.rname,r.rid,r.menuname,r.price,r.hidno, r.imgid, i.img from rfi as r, image as i where r.imgid=i.imageid ";
if($conn->query($sql) === TRUE){
	echo "View users created successfully";
	
}else{
	echo "Error creating table: ";
	echo "<br/>";
	echo $conn->error;
}

$conn->close();
?>