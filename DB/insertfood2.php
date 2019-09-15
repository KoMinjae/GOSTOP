<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');
$url1 = "http://data.ex.co.kr/openapi/business/representFoodServiceArea?key=test&type=xml&numOfRows=99&pageNo=2";

$data1 = file_get_contents($url1);
$xml1 = simplexml_load_string($data1);
 foreach($xml1->children() as $value) {
     $v1= $value->batchMenu; //MenuName
	 $v2= $value->salePrice; //Menu Price
	 $acode= $value->serviceAreaCode; //고속도로코
	 $v3=substr($acode,-3); //고속도로코드
	 $v4= $value->serviceAreaName;//휴게소 이름
	 //echo '$v1', '$v2', '$v3';
	 $sql = "INSERT INTO food(MenuName, Price,AreaCode, AreaName)VALUES( '$v1','$v2','$v3', '$v4')";
	 mysqli_query($conn,'set names utf-8');
	 mysqli_query($conn,$sql);
	 
	 printf($sql);

	 

 }

$conn->close();
?>

