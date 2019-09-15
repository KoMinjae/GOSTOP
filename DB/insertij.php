<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');
$url1 = "http://data.ex.co.kr/openapi/locationinfo/locationinfoIc?key=5265340885&type=xml";

$data1 = file_get_contents($url1);
$xml1 = simplexml_load_string($data1);
 foreach($xml1->children() as $value) {
     
	 $v1= $value->icCode; //ic,jc code
	 $v2= $value->icName; //ic,jc name
	 $v3= $value->xValue; //x좌표
	 $v4= $value->yValue;//y좌표
	 $v5= $value->routeNo;//고속도로 코드
	 //echo '$v1', '$v2', '$v3';
	 $sql = "INSERT INTO ICJC(Code, IJNAME, LOC_X, LOC_Y,Highid1)VALUES('$v1', '$v2','$v3', '$v4','$v5')";
	 mysqli_query($conn,'set names utf-8');
	 mysqli_query($conn,$sql);
	 
	 printf($sql);

	 

 }

$conn->close();
?>

