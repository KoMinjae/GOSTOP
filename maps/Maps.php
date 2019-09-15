<!DOCTYPE html>
<html>
<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <link href="css/header_m.css" rel="stylesheet" />    
   <link href="css/footer_m.css" rel="stylesheet" />

</head>

<body onload="initialize()">

   <div class="container header">

      <table style="margin-left: 9%; margin-top: 10px;">
         <tr>
            <td><a href="../main.php"><img src="images/logo.png" width="260px" height="80px"></a></td>

            <td style="padding-left: 850px"><a href="../main.php"><img src="images/backspace.png" height="50px;" width="45px;"></a></td>
         </tr>
      </table>
   </div>


   <!--============================== content =======================================-->

   <div class="container" style="width: 110%; height: 800px; background-image:url(images/food_background.jpg); background-size: 100%;">

      <br><br><br><br>

      <div id="map_canvas" class="line" style="height: 600px; width: 950px; margin-left: 150px;"></div>

      <hr>

   </div>


   <!--============================== footer =======================================-->

   <footer>
      <div class="container">
         <div class="col-md-12">
            <br><br><br>
            <h2>About Us</h2>
            <br>
            <p>팀 소개&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;이용약관&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;개인정보처리방침&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;의견제안&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;서비스 안내&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;제휴제안&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;운영정책</p>

            <div class="copyright">
               <p>&copy; 충북대학교 소프트웨어학과 고민재 박경민 양회욱 2018 All Rights Reserved</p>
               <p>&#40;28644&#41; 충청북도 청주시 서원구 충대로1 충북대학교 &nbsp;&nbsp;전화: 043-123-1234 팩스: 0503-125-3422</p>
               <P>E-mail: cbnuDB@google.com &nbsp;&nbsp;사업자등록번호: 220-12-12345호 &nbsp;&nbsp;통신판매업 신고번호: 제2018-충북청주-1234호</P>
            </div>

            <ul class="social-icon">
               <li><a href="#" title="cbnu"><img src="images/cbnu.png"></a></li>
               <li><a href="#" title="Facebook"><img src="images/kakaotalk.jpg"></a></li>
               <li><a href="#" title="Twitter"><img src="images/facebook.jpg"></a></li>
               <li><a href="#" title="Youtube"><img src="Images/youtube.png"></a></li>
            </ul>   

         </div>
      </div>
   </footer>



   <!-- google maps -->

   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlw5V-9e_QhUy2uHe8mnupYiq0EZay6X4"
   type="text/javascript"></script>
   <script type="text/javascript">
  // 마크, 동선을 그리고 난 후 해당 위치를 array에 저장합니다.
  var MarkersArray = [];
  var MarkersArrayi = [];
  var Coordinates= [];
  var travelPathArray = [];
  var map;
  var icimg = new google.maps.MarkerImage("images/icon15.png",null,null,null,new google.maps.Size(25,25));
  var restimg = new google.maps.MarkerImage("images/icon32.png",null,null,null,new google.maps.Size(25,25));

  function initialize(){
     <?php
     //데이터 베이스 연동
     include_once 'dbconfig.php';
     $post_in = $_POST["ICIN"];
     $post_out = $_POST["ICOUT"];
     $process_control = 0;
     //매개변수 $one , $two 중에 더 큰 값을 return
     function comparehigh($one, $two){
        if($one > $two){
           return $one;
        }
        else
           return $two;
     }
     //매개변수 $one , $two 중에 더 큰 작은값을 return
     function comparelow($one, $two){
        if($one > $two){
           return $two;
        }
        else
           return $one;
     }
     $HighData[]=array();
     $LowData[]=array();
     $dbname = "dbpj";
     mysqli_select_db($conn, $dbname) or die('DB selection failed');

    // 출발 IC의 정보를 받아온다.
     $sql = "SELECT * FROM ic where iname = '$post_in'";
     $result = $conn->query($sql);
     $InIcData[] = array();
     // ic데이터를 1개의 row단위로 데이터를 불러온다.
     if($result->num_rows > 0){
        while($row = mysqli_fetch_array($result)){
           $InIcData = $row;
        }
        $process_control = 1;
     }
     // IN IC의 정보가 존재하지 않음.
     else{
        $process_control = 0 ;
     }

   // 도착 IC의 정보를 받아온다.
     $sql = "SELECT * FROM ic where iname = '$post_out'";
     $result = $conn->query($sql);
     $OutIcData[] = array(); 
     if($result->num_rows > 0){
      // Output data of each row
        while($row = mysqli_fetch_array($result)){
           $OutIcData = $row;
        }
        if($InIcData[0]>$OutIcData[0])

           $process_control = 1;
     }
     // OUT IC의 정보가 존재하지 않음.
     else{
        $process_control = 0 ;
     }


     if($process_control == 1){
        //IN IC와  OUT IC의 CODE 가 더 큰 쪽을 HighData 낮을 쪽을 LowData라고 변수를 지정
        if($InIcData[0]>$OutIcData[0]){
           $HighData = $InIcData;
           $LowData = $OutIcData;
        }else{
           $HighData = $OutIcData;
           $LowData = $InIcData;
        }   
        //더 높은 코드 쪽을 IN IC DATA로 사용
        //더 낮은 코드 쪽을 OUT IC DATA로 사용 
        $inHighId=$HighData[4];
        $outHighId=$LowData[4];
        $inILOC_X=$InIcData[2];
        $inILOC_Y=$InIcData[3];
        $outILOC_X=$OutIcData[2];
        $outILOC_Y=$OutIcData[3];
        $highx = $HighData[2];
        $lowx = $LowData[2];
        $highy = comparehigh($InIcData[3],$OutIcData[3]);
        $lowy = comparelow($InIcData[3],$OutIcData[3]);
        $HighId = $HighData[0];
        $lowId = $LowData[0];

    //case 1 : IN IC 와  OUT IC가 같은 도로에 존재 할 때 
    if ($inHighId === $outHighId){ //IN IC와 OUT IC의 고속도로번호가 같을 때
       // icjc 테이블에서 IN IC의 Hidno와 같은 id를 검색한다.
       $sql = "SELECT loc_x, loc_y, ijname FROM icjc where HighId1 = '$inHighId'  and Code <= '$HighId' and Code >= '$lowId'"; 
       $result = $conn->query($sql);
       $datai = array();
       // 1개씩 불러 들인다.
       // ic,jc데이터를 1개의 row단위로 데이터를 불러온다.
       if($result->num_rows > 0){
          while($row = mysqli_fetch_array($result)){
             $datai[] = $row; 
          }
       }
       // 해당 고속도로의 IN IC 와 OUT IC 사이에 있는 휴게소를 탐색
       $sql = "SELECT rloc_x, rloc_y, rname, rid, menuname, price,img FROM rest_inform where hidno = '$inHighId'  and RLOC_Y > '$lowy' and RLOC_Y < '$highy'";
       $result = $conn->query($sql);
       $data = array();
       if($result->num_rows > 0){
          while($row = mysqli_fetch_array($result)){
             $data[] = $row;  
          }
       }
    }

   else {// Case 2 : IN IC와  OUT IC가 하나의 jc를 거쳐서 연결되어 있을 때
       // input ic가 있는 도로의 모든 jc 정보를 가져온다. 
      $sql = "SELECT * FROM jc where (HighId1 = '$inHighId' and HighId2 = '$outHighId') or (HighId1 = '$outHighId' and HighId2 = '$inHighId') ";
      $result = $conn->query($sql);
      // 1개씩 JC를 불러들인다.
       // JC데이터를 1개의 row단위로 데이터를 불러온다.
      if($result->num_rows > 0){
         while($row = $result->fetch_assoc()){
            $jcIid1 = $row["Jid"];
            $jcIname1 = $row["Jname"];
            $jcILOC_X1 = $row["JLOC_X"];
            $jcILOC_Y1 = $row["JLOC_Y"];
            $jcHighId11 = $row["HighId1"];
            $jcHighId12 = $row["HighId2"];
         }
           // X ,Y 좌표 기준으로 작은 값과 큰 값을 결정한다.
         $jc_highx1 = comparehigh($highx, $jcILOC_X1);
         $jc_lowx1 = comparelow($lowx, $jcILOC_X1);
         $jc_highy1 = comparehigh($highy, $jcILOC_Y1);
         $jc_lowy1 = comparelow($lowy, $jcILOC_Y1);
           //jc가 연결된 두 고속도로 중에 Highid1을 기준으로 OUT IC의 번호와 같을 때 ic와 jc 탐색
         $sql = "SELECT loc_x, loc_y, ijname FROM icjc where HighId1 = '$outHighId'  and (LOC_Y >= '$jc_lowy1' and LOC_Y <='$jcILOC_Y1')";
         $result = $conn->query($sql);
         $datai1 = array();
         if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
               $datai1[] = $row; 
            }
         }

           //jc가 연결된 두 고속도로 중에 hdino을 기준으로 OUT IC의 번호와 같을 때 IN IC ~ JC 휴게소 탐색
         $sql = "SELECT rloc_x,rloc_y,rname,rid,menuname,price,img FROM rest_inform where hidno = '$outHighId' and (RLOC_Y >= '$jc_lowy1' and RLOC_Y <= '$jcILOC_Y1')";

         $result = $conn->query($sql);
         $data1 = array();
         if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
               $data1[] = $row; 
            }
         }   

         $jc_highx2 = comparehigh($outILOC_X, $jcILOC_X1);
         $jc_lowx2 = comparelow($outILOC_X, $jcILOC_X1);
         $jc_highy2 = comparehigh($outILOC_Y, $jcILOC_Y1);
         $jc_lowy2 = comparelow($outILOC_Y, $jcILOC_Y1);   
           //jc가 연결된 두 고속도로 중에 Highid1을 기준으로 IN IC의 번호와 같을 때 ic와 jc 탐색 
         $sql = "SELECT loc_x, loc_y, ijname FROM icjc where HighId1 = '$inHighId'  and (LOC_Y >= '$jcILOC_Y1' and LOC_Y <='$jc_highy2')";
         $result = $conn->query($sql);
         $datai2 = array();
         if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
               $datai2[] = $row; 
            }
         }

           //jc가 연결된 두 고속도로 중에 hdino을 기준으로 IN IC의 번호와 같을 때 OUT IC ~ JC 휴게소 탐색
         $sql = "SELECT rloc_x,rloc_y,rname, rid,menuname,price ,img FROM rest_inform where hidno = '$inHighId'  and (RLOC_Y >= '$jcILOC_Y1' and RLOC_Y <= '$jc_highy2')";
         $result = $conn->query($sql);
         $data2 = array();
         if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
               $data2[] = $row; 
            }
         }
         $datai = array_merge($datai1, $datai2);
         $data = array_merge($data1, $data2);
      }

       // Case 3 : IN IC와 OUT IC가 두번의 jc를 거쳐서 연결되어 있을 때 
       else{// JC를 1번 거쳐서 연결이 안됐을 경우
          $flag = 0;
        //IN IC기준으로 첫번째 JC에서 탐색
          $sql = "SELECT * FROM jc where (HighId1 = '$inHighId') or  (HighId2 = '$inHighId') ";
          $result = $conn->query($sql);
          if($result->num_rows > 0){
          // 1개씩 JC를 불러들인다.
          // JC데이터를 1개의 row단위로 데이터를 불러온다.
             while($row = $result->fetch_assoc()){
                $jcIid_1 = $row["Jid"];
                $jcIname_1 = $row["Jname"];
                $jcILOC_X_1 = $row["JLOC_X"];
                $jcILOC_Y_1 = $row["JLOC_Y"];
                $jcHighId_11 = $row["HighId1"];
                $jcHighId_12 = $row["HighId2"];
             // JC의 외래키인 HighID 2개 중에서 현재 고속도로가 아닌 다른고속도로를 나타내는 ID 탐색
             // 그것을 NEXT11 이라는 변수에 저장한다.
                if($inHighId==$jcHighId_11){
                   $next11 =  $jcHighId_12;
                }
                else{
                   $next11 =  $jcHighId_11;
                }
             // NEXT11 ID를 기준으로 다음 JC 탐색 
                $sql1 = "SELECT * FROM jc where HighId1 = '$next11' or  HighId2 = '$next11' ";
                $result1 = $conn->query($sql1);
                if($result1->num_rows > 0){
                //1개씩 JC를 불러들인다.
                //JC데이터를 1개의 row단위로 데이터를 불러온다.
                   while($row1 = $result1->fetch_assoc()){
                      $jcIid_2 = $row1["Jid"];
                      $jcIname_2 = $row1["Jname"];
                      $jcILOC_X_2 = $row1["JLOC_X"];
                      $jcILOC_Y_2 = $row1["JLOC_Y"];
                      $jcHighId_21 = $row1["HighId1"];
                      $jcHighId_22 = $row1["HighId2"];
                   // JC의 외래키인 HighID 2개 중에서 현재 고속도로가 아닌 다른고속도로를 나타내는 ID 탐색
                   // 그것을 NEXT22 라는 변수에 저장한다.
                      if($next11==$jcHighId_21){
                         $next22 =  $jcHighId_22;   
                      }
                      else{
                         $next22 =  $jcHighId_21;
                      }
                   // 도착 IC를 찾았을 경우
                      if($next22 == $outHighId){
                         $flag = 1;
                      }
                        if ($flag){ //찾았을 때 탐색을 멈춘다.
                           break;
                        }
                    }
                }
                if ($flag){ //찾았을 때 탐색을 멈춘다.
                   break;
                }
            }
        }

        $jc_highx1 = comparehigh($inILOC_X, $jcILOC_X_1);
        $jc_lowx1 = comparelow($inILOC_X, $jcILOC_X_1);
        $jc_highy1 = comparehigh($inILOC_Y, $jcILOC_Y_1);
        $jc_lowy1 = comparelow($inILOC_Y, $jcILOC_Y_1);
        //CASE 3 IN IC ~ 첫번째 JC 구간 휴게소 검색
        $sql = "SELECT loc_x, loc_y, ijname FROM icjc where HighId1 = '$inHighId'  and LOC_Y >= '$jc_lowy1' and LOC_Y <='$jc_highy1'";
        $result = $conn->query($sql);
        $datai1 = array();
        if($result->num_rows > 0){
           while($row = mysqli_fetch_array($result)){
              $datai1[] = $row; 
           }
        }
        $sql = "SELECT rloc_x,rloc_y,rname, rid,menuname,price ,img FROM rest_inform where hidno = '$inHighId' and  RLOC_Y > '$jc_lowy1' and RLOC_Y < '$jc_highy1'";
        $result = $conn->query($sql);
        $data1 = array();
        if($result->num_rows > 0){
           while($row = mysqli_fetch_array($result)){
              $data1[] = $row; 
           }
        }
        
        $jc_highx2 = comparehigh($jcILOC_X_1, $jcILOC_X_2);
        $jc_lowx2 = comparelow($jcILOC_X_1, $jcILOC_X_2);
        $jc_highy2 = comparehigh($jcILOC_Y_1, $jcILOC_Y_2);
        $jc_lowy2 = comparelow($jcILOC_Y_1, $jcILOC_Y_2);
        //CASE 3 첫번째 JC ~ 두번째 JC 구간 휴게소 검색
        $sql = "SELECT loc_x, loc_y, ijname FROM icjc where HighId1 = '$next11'  and LOC_Y >= '$jc_lowy2' and LOC_Y <='$jc_highy2'";
        $result = $conn->query($sql);
        $datai2 = array();
        if($result->num_rows > 0){
           while($row = mysqli_fetch_array($result)){
              $datai2[] = $row; 
           }
        }
        $sql = "SELECT rloc_x,rloc_y,rname, rid,menuname,price ,img FROM rest_inform where hidno = '$next11'  and RLOC_Y > '$jc_lowy2' and RLOC_Y < '$jc_highy2'";
        $result = $conn->query($sql);
        $data2 = array();
        if($result->num_rows > 0){
           while($row = mysqli_fetch_array($result)){
              $data2[] = $row; 
           }
        }
        
        $jc_highx3 = comparehigh($outILOC_X, $jcILOC_X_2);
        $jc_lowx3 = comparelow($outILOC_X, $jcILOC_X_2);
        $jc_highy3 = comparehigh($outILOC_Y, $jcILOC_Y_2);
        $jc_lowy3 = comparelow($outILOC_Y, $jcILOC_Y_2);
        //CASE 3 두번째 JC ~ OUT IC 구간 휴게소 검색
        $sql = "SELECT loc_x, loc_y, ijname FROM icjc where HighId1 = '$outHighId'  and LOC_Y >= '$jc_lowy3' and LOC_Y <='$jc_highy3'";
        $result = $conn->query($sql);
        $datai3 = array();
        if($result->num_rows > 0){
           while($row = mysqli_fetch_array($result)){
              $datai3[] = $row; 
           }
        }

        $sql = "SELECT rloc_x,rloc_y,rname, rid,menuname,price,img FROM rest_inform where hidno = '$outHighId'  and RLOC_Y > '$jc_lowy3' and RLOC_Y < '$jc_highy3'";
        $result = $conn->query($sql);
        $data3 = array();
        if($result->num_rows > 0){
           while($row = mysqli_fetch_array($result)){
              $data3[] = $row; 

           }
        } 

        // 구글맵에 띄울 수 있도록 각 구간의 데이터를들 MERGE
        $datai = array_merge($datai1, $datai2);
        $datai = array_merge($datai,$datai3);
        $data = array_merge($data1, $data2);
        $data = array_merge($data,$data3);
    }
}
}

?>
//datai 2차원 배열을 생성하고 ic와jc의 정보를 입력한다.
var a = ('<?= sizeof($datai) ?>');
var i = 0;
var numai = parseInt(a);
var datai = new Array();
<?php
for($i = 0; $i< sizeof($datai); $i++){
   ?>
   var datai_sub = new Array();
   datai_sub[0] = (<?= $datai[$i][0] ?>);
   datai_sub[1] = (<?= $datai[$i][1] ?>);
   datai_sub[2] = ('<?= $datai[$i][2] ?>');
           datai.push(datai_sub);                  
           //php 로 받은 2차원 배열을 자바스크립트 함수로 이동
           
           <?php
       }
       ?>
        //data 2차원 배열을 생성하고 php로받은 휴게소,음식,이미지 값을 저장한다
       var a = ('<?= sizeof($data) ?>');
       var i = 0;
       var numa = parseInt(a);
       var data = new Array();
       <?php
       for($i = 0; $i< sizeof($data); $i++){
          ?>
          var data_sub = new Array();
          data_sub[0] = (<?= $data[$i][0] ?>);
          data_sub[1] = (<?= $data[$i][1] ?>);
          data_sub[2] = ('<?= $data[$i][2] ?>');
          data_sub[3] = ('<?= $data[$i][3] ?>');
          data_sub[4] = ('<?= $data[$i][4] ?>');
          data_sub[5] = ('<?= $data[$i][5] ?>');
          data_sub[6] = ('<?= $data[$i][6] ?>');
           data.push(data_sub);                 
            //php 로 받은 2차원 배열을 자바스크립트 함수로 이동
           
           <?php
       }
       ?>

    var myLatlng = new google.maps.LatLng(36.631841, 127.456119);  //초기 지도 위치
    var myOptions = {
        zoom: 8, // 줌
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP // 로드맵 타입
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); //
    for(i = 0; i< numai; i++){
       //지도에 ic,jc 좌표값 입력
       data_inputi(i,parseFloat(datai[i][1]),parseFloat(datai[i][0])); 
   }
   for(i = 0; i< numa; i++){
         //지도에 휴게소 좌표값 입력
       data_input(i,parseFloat(data[i][1]),parseFloat(data[i][0]));        
   }


    // 만약에  3개의 휴게소를 지난다고 했을 경우 조건 : 각각의 좌표를 알아야한다.
    
    function data_inputi(i,Loc_x, loc_y){
       var location = {lat:Loc_x, lng:loc_y};
       var marker = new google.maps.Marker({ //마커생성
          position: {lat:Loc_x, lng:loc_y}, 
          map: map,
          title : datai[i][2], //마커의 title 은 ic,jc의 name값
          icon: icimg
       });
       var contentString = datai[i][2];
       var infowindow = new google.maps.InfoWindow({
          content : contentString
       });
      //marker.setVisible(flase);
      marker.addListener('click',function(){
         infowindow.open(map,marker);
      });
      attachMessage(marker, location); // 마커 클릭했을때 이벤트 발생
      Coordinates.push(location); //좌표위치 담기
      MarkersArrayi.push(marker);//마커 담기
      flightPath();//array에 담은 위도,경도 데이타를 가지고 동선 그리기
  }
  function data_input(i,Loc_x, loc_y){
     var location = {lat:Loc_x, lng:loc_y};
     var marker = new google.maps.Marker({ 
        position: {lat:Loc_x, lng:loc_y}, 
        map: map,
        title : data[i][3], //마커의 이름은 휴게소의 이름값
        icon : restimg
     });
     var restid = data[i][3]; //휴게소 id값 저장
     var restname = data[i][2];  //휴게소 이름 저장
     var menuname = data[i][4]; //메뉴의 이름 저장
     var price = data[i][5];  //메뉴의 가격 저장
     var img = data[i][6];//메뉴의 이미지 값 저장
     var contentopen = '<div style="width: 100%; height: 100%; padding: 20px; padding-left: 18%; padding-right: 110px; background-image:url(images/marker_back.jpg); background-size: 100%;"><h4>휴게소</h4><p>&nbsp;&nbsp;'+restname+'</p><br><h4>추천메뉴</h4><p>&nbsp;&nbsp;'+menuname+'</p><br><h4>가격</h4><p>&nbsp;&nbsp;'+price+'</p><img src="'+img+'" style="width: 180px; height: 120px;"><br></div>' //마커를 클릭했을때 정보창에 뜨게할 html 구문

     var infowindow = new google.maps.InfoWindow({
        content : contentopen, //infowindonw 의 내용은 위에 정의한 contentopen
        maxWitdh : 270
     });
      //marker.setVisible(flase);
      marker.addListener('click',function(){
         infowindow.open(map,marker);
      });
      attachMessage(marker, location); // 마커 클릭했을때 이벤트 발생
      Coordinates.push(location); 
      MarkersArray.push(marker);//마커 담기
  }

  //해당 위치에 주소를 가져오고, 마크를 클릭시 infowindow에 주소를 표시한다.
  function attachMessage(marker, latlng) {
     geocoder = new google.maps.Geocoder();
     geocoder.geocode({'latLng': latlng}, function(results, status){
        if (status == google.maps.GeocoderStatus.OK) {
           if (results[0]) {
              var address_nm = results[0].formatted_address;
              var infowindow = new google.maps.InfoWindow({   
                 content: address_nm,
                 size: new google.maps.Size(50,50)
              });
            google.maps.event.addListener(marker, 'click', function(){ 
            // 마커 클릭하면 주소가져오기 --> 옆에 창 띄우기로 바꾸기 
               infowindow.open(map,marker);
          });
        }
        else {
           alert('주소 가져오기 오류!'); 
        }
    }
});
  }
  
  //동선그리기
  function flightPath(){
     for (i in travelPathArray){
        travelPathArray[i].setMap(null);
     }

     var flightPath = new google.maps.Polyline({
        path: Coordinates,
        strokeColor: "#0100FF",
        strokeOpacity: 0.8,
        strokeWeight: 2
     });
     flightPath.setMap(map);
     travelPathArray.push(flightPath);
  }
}

/*========================*/


</script>
</body>
</html>