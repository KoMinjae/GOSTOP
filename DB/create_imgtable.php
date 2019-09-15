<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql =	"CREATE TABLE image(
   	imageid int(4) AUTO_INCREMENT,
   	img varchar(255),
   	PRIMARY KEY(imageid)
	)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";

if($conn->query($sql) === TRUE){
	echo "Table users created successfully";
}else{
	echo "Error creating table: ";
	echo "<br/>";
	echo $conn->error;
}

$conn->close();
?>