<?php
$servername = "localhost:3306";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if($conn->connect_error){
	die("Connection failed: " + $conn->connect_error);
}

// Select a database
$dbname = "dbpj";
mysqli_select_db($conn, $dbname) or die('DB selection failed');

?>


<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/search_data.js"></script>

  <link href="css/header.css" rel="stylesheet" />	 
  <link href="css/footer.css" rel="stylesheet" />
  <link href="css/content.css" rel="stylesheet" />
  <link href="css/search.css" rel="stylesheet" />	
  <link href="css/newpage.css" rel="stylesheet" /> 

</head>

<body onload="initialize()">

<div class="container background">
  <div class="header">
 	<table style="margin-left: 13%; margin-top: 60px;">
 		<tr>
 			<td><a href="main.php"><img src="images/logo.png" width="260px" height="80px"></a></td>
 			<td style="padding-left: 650px;"><a href="#" value="person" onclick="search_person();"><img src="images/person.png" height="30px;" width="30px;" ></a></td>
 			<td style="padding-left: 20px"><a href="#" value="route" onclick="search_route();"><img src="images/route.png" height="30px;" width="30px;"></a></td>
 			<td style="padding-left: 20px"><a href="#" value="korea" onclick="search_korea();"><img src="images/korea.png" height="30px;" width="30px;"></a></td>
 			<td style="padding-left: 20px"><a href="#" value="list" onclick="search_list();"><img src="images/list.png" height="30px;" width="30px;"></a></td>
 		</tr>
 	</table>
 </div>



 <br></br><br></br>

<p class="welcome">We invite you to a rest stops' restaurant of about 250 all parts of the country</p>

 <div class="container log">
  <br>
  <form action = "maps/Maps.php" method="POST" autocomplete="off">    

    <br><br>
    <div class="input-group">
      <span class="input-group-addon" ><i class="glyphicon glyphicon glyphicon-log-in"></i></span>
      <input style="width:100%" id="in" type="text" class="form-control" name="ICIN" placeholder="The start of a highway">
    </div>

    <br>

    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-log-out"></i></span>
      <input style="width:100%" id="out" type="text" class="form-control" name="ICOUT" placeholder="The end of a highway">
    </div>

    <br><br>


    <div class="input-group">
      <button style="width:370px; font-color: white" type="submit" value="search" class="btn btn-warning">Search
    </div>
  </form>
 </div>
</div>


<!--page_person 부분-->

<div id="page_person" style="height: 1200px; width: 100%; display: none;">

  <div class="header_duce">
    <p> Developers </p>
  </div>

  <div class="container" style= "width: 100%;">


    <table class="introduce-left" style="margin-top: 100px;">
      <tr>
        <td rowspan="5"><h1>Ko Minjae</h1></td>
        <td>Age: 26</td>
      </tr>
      <tr>
        <td>School: Chungbuk National University</td>
      </tr>
      <tr>
        <td>Major: Software</td>
      </tr>
      <tr>
        <td>Language: C/C++, Python, Java</td>
      </tr>
    </table>

    <br><br><br><br>

    <table class="introduce-right">
      <tr>
        <td rowspan="4"><h1>Park Kyungmin</h1></td>
        <td>Age: 25</td>
      </tr>
      <tr>
        <td>School: Chungbuk National University</td>
      </tr>
      <tr>
        <td>Major: Software</td>
      </tr>
      <tr>
        <td>Language: C/C++, Python, Java</td>
      </tr>
    </table>

    <br><br><br><br>

    <table class="introduce-left">
      <tr>
        <td rowspan="4"><h1>Yang Hoiuk</h1></td>
        <td>Age: 25</td>
      </tr>
      <tr>
        <td>School: Chungbuk National University</td>
      </tr>
      <tr>
        <td>Major: Software</td>
      </tr>
      <tr>
        <td>Language: C/C++, Python, Java</td>
      </tr>
    </table>

    <br><br><br><br><br>
    <hr>
    <br><br><br><br>

  </div>
</div>



<!--page_route 부분-->

<div id="page_route" style="height: 1600px; width: 100%; display: none;">

  <div class="header_duce">
    <p> Introduce </p>
  </div>

  <br><br><br>

  <p class="title_p center">"달리는 고속도로에서 잠깐의 맛있는 휴식을 소개합니다."</p>
  

  <img src="images/road.png" class="center" style="margin-top: 50px;">

  <br><br><br><br><br><br>

  <table class="center table_r">
    <tr>
      <td><img src="images/easy.png" ></td>
      <td><img src="images/food.png"></td>
      <td><img src="images/rest.png"></td>
    </tr>
    <tr>
      <td><center>출발지와 도착지 입력만으로<br> 쉽게 이용할 수 있습니다.</center></td>
      <td><center>각 지역의 다양한 먹거리를 <br>한눈에 볼 수 있습니다.</center></td>
      <td><center>가는 길에 쉴 수 있는 휴게소를 <br>간편하게 알 수 있습니다.</center></td>
    </tr>
  </table>

  <br><br><br><br><br>
  <hr>

</div>


<!--page_korea 부분-->

<div id="page_korea" style="height: 900px;  display: none;">

  <div class="container" id="map_canvas" style="margin-left: 25%; height: 700px; width: 700px;"></div>

</div>


<!--page_list 부분-->

<div id="page_list" style="height: 900px;  display: none;">
 
   <br><br><br><br><br> <br><br><br><br><br><br><br><br>
      <img src="images/logo.png" class="center_logo">
   <br><br><br>
   <center><p class="ment">" 고속도로에서의 휴식 "</p></center>
   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   <hr>

</div>




<!--======================================================================================================-->

<br><br><br>

	<footer>
		<div class="container">
			<div class="col-md-12">
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

<br><br>



   <!-- 부트스트랩 -->

<script>

function search_person() {

    document.getElementById("page_route").style.display = "none";
    document.getElementById("page_korea").style.display = "none";
    document.getElementById("page_list").style.display = "none";
    document.getElementById("page_person").style.display = "block";
}

function search_route() {

    document.getElementById("page_person").style.display = "none";
    document.getElementById("page_korea").style.display = "none";
    document.getElementById("page_list").style.display = "none";
    document.getElementById("page_route").style.display = "block";
}

function search_korea() {

    document.getElementById("page_route").style.display = "none";
    document.getElementById("page_list").style.display = "none";
    document.getElementById("page_person").style.display = "none";
    document.getElementById("page_korea").style.display = "block";
}

function search_list() {

    document.getElementById("page_route").style.display = "none";
    document.getElementById("page_korea").style.display = "none";
    document.getElementById("page_person").style.display = "none"
    document.getElementById("page_list").style.display = "block";;
}



$("a[value=person]").click(function() {
        $('html,body').animate({
        scrollTop: $("#page_person").offset().top},'slow');
      });

$("a[value=route]").click(function() {
        $('html,body').animate({
        scrollTop: $("#page_route").offset().top},'slow');
      });


$("a[value=korea]").click(function() {
        $('html,body').animate({
        scrollTop: $("#page_korea").offset().top},'slow');
      });


$("a[value=list]").click(function() {
        $('html,body').animate({
        scrollTop: $("#page_list").offset().top},'slow');
      });


</script>


<!-- google maps -->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlw5V-9e_QhUy2uHe8mnupYiq0EZay6X4"
  type="text/javascript"></script>
  <script type="text/javascript">
  // 마크, 동선을 그리고 난 후 해당 위치를 array에 저장합니다.
  var code=[]; // 휴게소코드를 저장할  배열 
  code[0]="aasd";
  var MarkersArray = [];
  var Coordinates= [];
  var travelPathArray = [];
  var map;

  function initialize(){

    var myLatlng = new google.maps.LatLng(36.631841, 127.456119);  //초기 지도 위치
    var myOptions = {
        zoom: 8, // 줌
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP // 로드맵 타입
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); //
    data_input(36.631841, 127.456119); //중문

  

    // 만약에  3개의 휴게소를 지난다고 했을 경우 조건 : 각각의 좌표를 알아야한다.
    function data_input(Loc_x, loc_y){
      var location = {lat:Loc_x, lng:loc_y};
      var marker = new google.maps.Marker({ 
      position: {lat:Loc_x, lng:loc_y}, 
        map: map,
      });
      attachMessage(marker, location); // 마커 클릭했을때 이벤트 발생
      Coordinates.push(location); 
      MarkersArray.push(marker);//마커 담기
      flightPath();//array에 담은 위도,경도 데이타를 가지고 동선 그리기
    }

  }




/*========================*/

var infowindow = new google.maps.InfoWindow({
  content:"Hello World!"
  });

google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
  });


</script>

<style>
  #map {
        height: 30px;  
        width: 20px;  
        float :left;
  }
</style>




<!--=========== 자동완성 =============-->
<script>

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

//search_Data

//전국 IC데이터 
var countries = ["구서IC", "양산IC", "통도사IC", "서울산IC", "경주IC", "건천IC", "영천IC", "경산IC", "동대구IC", 
"북대구IC", "왜관IC", "남구미IC", "구미IC", "김천IC", "추풍령IC", "황간IC", "영동IC", "옥천IC", "대전IC", 
"신탄진IC", "청원IC", "청주IC", "목천IC", "천안IC", "안성IC", "오산IC", "기흥IC", "수원IC", "판교IC", 
"양재IC", "서초IC", "반포IC", "판교IC", "노포IC", "서순천IC", "순천IC", "광양IC", "동광양IC", "옥곡IC", 
"하동IC", "진교IC", "곤양IC", "축동IC", "사천IC", "진주IC", "문산IC", "진성IC", "지수IC", "군북IC", "장지IC", 
"함안IC", "서마산IC", "동마산IC", "동창원IC", "진례IC", "서김해IC", "동김해IC", "담양IC", "순창IC", "남원IC", 
"지리산IC", "함양IC", "함양IC", "거창IC", "해인사IC", "고령IC", "성산IC", "무안공항IC", "북무안IC", "나주IC", 
"서광산IC", "문평IC", "동함평IC", "북광주IC", "장성물류IC", "남고창IC", "목포IC", "일로IC", "무안IC", "함평IC", 
"영광IC", "고창IC", "선운산IC", "줄포IC", "부안IC", "서김제IC", "동군산IC", "군산IC", "서천IC", "춘장대IC", "대천IC", 
"광천IC", "홍성IC", "해미IC", "서산IC", "당진IC", "송악IC", "서평택IC", "발안IC", "비봉IC", "매송IC", "목감IC", "광명역IC", 
"무창포IC", "부여IC", "서공주IC", "청양IC", "서부여IC", "어연IC", "장수IC", "진안IC", "완주IC", "소양IC", "청통와촌IC", 
"북영천IC", "서포항IC", "승주IC", "주암IC", "석곡IC", "곡성IC", "옥과IC", "창평IC", "동광주IC", "서광주IC", "광산IC", 
"장성IC", "백양사IC", "내장산IC", "정읍IC", "태인IC", "금산사IC", "김제IC", "서전주IC", "전주IC", "삼례IC", "익산IC", 
"연무IC", "서논산IC", "탄천IC", "공주IC", "정안IC", "남천안IC", "동전주IC", "상관IC", "오수IC", "임실IC", "북유성IC", 
"공주IC", "면천IC", "신양IC", "동공주IC", "유구IC", "문의IC", "회인IC", "보은IC", "속리산IC", "화서IC", "남상주IC", 
"마곡사IC", "낙동IC", "예산IC", "고덕IC", "서진주IC", "단성IC", "산청IC", "생초IC", "지곡IC", "서상IC", "덕유산IC", 
"무주IC", "금산IC", "추부IC", "남대전IC", "판암IC", "서청주IC", "오창IC", "증평IC", "진천IC", "대소IC", "일죽IC", 
"곤지암IC", "광주IC", "하남IC", "연화산IC", "동고성IC", "통영IC", "북통영IC", "고성IC", "청북IC", "송탄IC", 
"서안성IC", "남안성IC", "북진천IC", "칠서IC", "남지IC", "영산IC", "창녕IC", "선산IC", "상주IC", "충주IC", "북충주IC", 
"감곡IC", "북상주IC", "점촌함창IC", "문경새재IC", "연풍IC", "괴산IC", "서여주IC", "성주IC", "남김천IC", "월곶IC", 
"서안산IC", "안산IC", "군포IC", "동군포IC", "부곡IC", "북수원IC", "동수원IC", "마성IC", "용인IC", "양지IC", 
"덕평IC", "이천IC", "여주IC", "문막IC", "원주IC", "새말IC", "둔내IC", "면온IC", "장평IC", "속사IC", "진부IC", 
"횡계IC", "칠곡IC", "다부IC", "가산IC", "군위IC", "의성IC", "남안동IC", "서안동IC", "예천IC", "영주IC", "풍기IC", 
"단양IC", "북단양IC", "남제천IC", "제천IC", "신림IC", "남원주IC", "북원주IC", "횡성IC", "홍천IC", "춘천IC", 
"덕소삼패IC", "화도IC", "서종IC", "설악IC", "강촌IC", "남춘천IC", "조양IC", "동홍천IC", "망상IC", "옥계IC", 
"강릉IC", "현남IC", "북강릉IC", "동해IC", "남강릉IC", "온양IC", "청량IC", "기장IC", "문수IC", "장안IC", "하조대IC", 
"성남IC", "송파IC", "서하남IC", "상일IC", "강일IC", "토평IC", "남양주IC", "구리IC", "퇴계원IC", "평촌IC", "산본IC", 
"시흥IC", "장수IC", "송내IC", "중동IC", "계양IC", "김포IC", "일산IC", "북창원IC", "장유IC", "가락IC", "서부산IC", 
"사상IC", "남동IC", "신천IC", "광명IC", "석수IC", "도화IC", "가좌IC", "서인천IC", "부평IC", "부천IC", "정남IC", 
"공항신도시IC", "논산IC", "계룡IC", "유성IC", "북대전IC", "서대전IC", "안영IC", "북오산IC", "향남IC", "봉담IC", "오성IC", 
"현풍IC", "화원IC", "남대구IC", "성서IC", "서대구IC", "물금IC", "남양산IC", "가산IC"];

//autocomplete
autocomplete(document.getElementById("in"), countries);
autocomplete(document.getElementById("out"), countries);


</script>


</body>
</html>