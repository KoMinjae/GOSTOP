<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

// Create table
$sql =	"CREATE TABLE food(
	id INT(4) UNSIGNED AUTO_INCREMENT, 
	MenuName VARCHAR(255),
	Price VARCHAR(10),
	AreaCode VARCHAR(255),
	AreaName VARCHAR(255),
	Imageid int(10) default 1,
	PRIMARY KEY(id),
	FOREIGN KEY(AreaCode) REFERENCES rest_stop(Rid),
	FOREIGN KEY(Imageid) REFERENCES image(imageid)
	)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

if($conn->query($sql) === TRUE){
	echo "Table users created successfully";
	echo "<br/><a href='insert.php'>Click to add data !</a>";
}else{
	echo "Error creating table: ";
	echo "<br/>";
	echo $conn->error;
}

$conn->close();
?>