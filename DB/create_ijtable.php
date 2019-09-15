<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql =	"CREATE TABLE ICJC(
	Code VARCHAR(255),
	IJNAME VARCHAR(255),
	LOC_X FLOAT(10),
	LOC_Y FLOAT(10),
	Highid1 varchar(255),
	Highid2 varchar(255),
	PRIMARY KEY(Code),
	FOREIGN KEY(Highid1) references Highway(Hid),
	FOREIGN KEY(Highid2) references Highway(Hid)
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