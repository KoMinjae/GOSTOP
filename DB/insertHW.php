<?php
include_once 'dbconfig.php';

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

	 $sql = "INSERT INTO Highway(Hid, Hname)VALUES('0010','경부선'),
	 ('0100','남해선'),('0101','남해선(영암-순천'),('0120','88올림픽선'),('0121','무안광주선'),('0140','고창담양선'),('0150','서해안선'),('0153','평택시흥선'),('0160','울산선'),('0170','평택화성선'),('0200','대구포항선'),('0201','익산장수선'),('0251','호남선'),('0252','천안논산선'),('0270','순천완주선'),('0300','청원상주선'),('0301','당진대전선'),('0351','중부선(대전통영)'),('0352','중부선'),('0370','제2중부선'),('0400','평택제천선'),('0450','중부내륙선'),('0500','영동선'),('0550','중앙선'),('0552','대구부산선'),('0600','서울양양선'),('0650','동해선'),('0651','부산울산선'),('1000','서울외곽순환선'),('1020','남해제1지선'),('1040','남해제2지선'),('1100','제2경인선'),('1102','인천대교선'),('1200','경인선'),('1300','인천국제공항선'),('1510','서천공주선'),('1710','용인서울선'),('2510','호남선지선'),('3000','대전남부순환선'),('3300','제3경인선'),('4000','봉담동탄선'),('4510','중부내륙지선'),('5510','중앙선지선')";
	 mysqli_query($conn,'set names utf-8');
	 mysqli_query($conn,$sql);
	 
	 printf($sql);

$conn->close();
?>

