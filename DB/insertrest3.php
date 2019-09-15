<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');
$url1 = "http://data.ex.co.kr/openapi/locationinfo/locationinfoRest?key=test&type=xml&numOfRows=99&pageNo=3";

$data1 = file_get_contents($url1);
$xml1 = simplexml_load_string($data1);
 foreach($xml1->children() as $value) {
     $v1= $value->unitCode; //휴게소코드
	 $v2= $value->unitName; //휴게소이름
	 $v3= $value->xValue; //휴게소 x좌표
	 $v4= $value->yValue; //휴게소 y 좌표
	 $v5= $value->routeNo;
	 $sql = "INSERT INTO Rest_stop(Rid,Rname, RLOC_X, RLOC_Y,hidno)VALUES('$v1', '$v2','$v3','$v4','$v5')";
	 mysqli_query($conn,'set names utf-8');
	 mysqli_query($conn,$sql);
	 
	 printf($sql);

	 

 }

$conn->close();
?>

