<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql =	"CREATE TABLE Rest_stop(
	Rid VARCHAR(4), 
	Rname VARCHAR(255),
	RLOC_X float(10),
	RLOC_Y float(10),
	hidno varchar(255),
	PRIMARY KEY(Rid),
	FOREIGN KEY (hidno) REFERENCES HIGHWAY(Hid)
	)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

if($conn->query($sql) === TRUE){
	echo "Table users created successfully";
	
}else{
	echo "Error creating table: ";
	echo "<br/>";
	echo $conn->error;
}

$conn->close();
?>