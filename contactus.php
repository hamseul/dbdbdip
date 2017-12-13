<?php
  session_start();
  include_once("db_config.php");
  include("include/session_timer.php");
 ?>

<!DOCTYPE html>
<html>
<head>
<title>WoW SYSTEM</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBERyEWbuTysaEykWLc3d_5rcXJB6FcGUc&callback=initMap"></script>
<style>
.w3-sidebar a {font-family: "Open Sans", "Nanum Gothic", sans-serif}
body,p,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Open Sans", "Nanum Gothic", sans-serif;}

/* 좌측 사이드바에서 메뉴 클릭시 해당 메뉴 폰트 색 */
.activeFont {
  color: #ff8400;
}
.activeSemiLabel {
  color: #ffffff;
  background-color: #ff8400;
}
/***********************************************/
.semiLabel {
  background-color: #222222;
}

.box{ border:4px dotted green; }

.semiLabelBorder {
  border-bottom: 1px solid #393939;
}
.productImgStyle{
    width:100%;
}

.productName{
background-color:#e6e9ed;
color: #2c2d32;
}

.buttonForContents{
color:white;
background-color: rgba( 255, 255, 255, 0 );
}

.productImage
{
    width:100%;
    background-color: rgba( 0, 0, 0, 0.3 );
}

</style>
<script type='text/javascript'>
$(document).ready(function(){
  $('#contactUsPage').addClass("activeFont");     // 해당 메뉴의 초기 상태는 항상 하이라이팅

  /*  클릭 이벤트 설정  */
  // Product 메뉴가 아닌 다른 메뉴를 클릭했을 때
  // Product 메뉴가 펼쳐져 있다면 닫고, 해당 메뉴를 하이라이팅한다.
    $('.sideBarLabel >a').click(function(){
      $('.sideBarLabel >a').removeClass("activeFont");  // 기존의 activeFont 속성이 있던 메뉴들 다 지우기
      $(this).addClass("activeFont");         // activeFont 속성 추가

      if ($(this).attr('name') != 'productPage') {
      var atrObj = $(this).attr('name');        // 클릭한 a 링크의 name을 따와서
      $(document.getElementById(atrObj)).show();  // 동일한 name의 id를 가진 div를 연다.
    }
    });

  $('.semiLabelBorder >a').click(function(){    // product 메뉴의 부가 메뉴들을 클릭했을 때
    $('.semiLabelBorder >a').removeClass("activeSemiLabel");  // 기존의 부가 메뉴들 하이라이팅 효과들을 전부 제거하고
    $(this).addClass("activeSemiLabel");                      // 새로운 하이라이팅 효과를 추가한다.
  });
});
</script>
</head>

<body class="w3-content" style="max-width:1280px; background-color:#2c2d32;">

  <div id='id01' class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; background-color:#2c2d32;">
        <form class="w3-container" form action="changepw.php" method="POST">
          <div class="w3-section">
            <label style="color:white;"><b>CURRENT Password</b></label>
            <input class="w3-input w3-border" type="password" placeholder="Enter current PW" name="inputpw" required>
            <label style="color:white;"><b>NEW Password</b></label>
            <input class="w3-input w3-border" type="password" placeholder="Enter new PW" name="inputcpw" required>
            <button class="w3-left w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:#ff8400; color:white;" type="submit"><b>CHANGE</b></button>
            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-right w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:#ff8400; color:white;"><b>Cancel</b></button>
          </div>

        </form>
      </div>
    </div>

<!-- Sidebar/menu -->
<?php include("include/sidebar.php"); ?>

<!-- !PAGE CONTENT! -->
<div class="" style="margin-left:250px">

  <!-- Top header -->
<?php include("include/topheader.php"); ?>

  <!-- 여기부터 본문 레이아웃 폼 -->
  <div id=bodyContent>

    <!-- Contact Us 페이지 -->
    <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;width:1030px;margin:0px;height:100%">
        <h2 class="w3-padding"><b>Contact</b> Us</h2>
      </div>

      <div class="w3-border" id="map" style="position: absolute;z-index:1;width:1030px;height:1000px">

      </div>
      <div class="w3-container" style="position: absolute; z-index:2; margin: 32px 32px 0px 32px; background-color:rgba(44, 45, 50, 0.95); color: #ffffff; width: 450px; height: 73px; padding:0px">
          <div class="w3-xlarge" style="width:500px;height:53px;margin-left:16px">
            <div class="w3-padding-16 w3-left"><img src="img/wow.png" alt="wow.png" style="width:70px"/></div>

            <div class="w3-left w3-padding-16">&nbsp;&nbsp;&nbsp;&nbsp;(주)와우시스템</div>
          </div>
          <div class="" style="width:450px; height:350px; margin-top: 12px; background-color:rgba(44, 45, 50, 0.80)">
            <h4 style="padding-top: 8px; padding-left: 64px"><br/><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;&nbsp;경기도 성남시 중원구 사기막골로 124,</h4>
            <h4 style="padding-left: 64px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SKⓝ테크노파크, 메가동 411호</h4>
            <h4 style="padding-left: 64px"><br/><i class="material-icons">call</i>&nbsp;&nbsp;&nbsp;&nbsp;070. 8193. 7410</h4>
            <h4 style="padding-left: 64px"><br/><i class="fa fa-fax"></i>&nbsp;&nbsp;&nbsp;&nbsp;0303. 0799. 1298</h4>
            <h4 style="padding-left: 64px"><br/><i class="material-icons">email</i></h4>
          </div>
      </div>

      <script>
      function initMap() {
        var company = {lat: 37.44001, lng: 127.17763};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: company
        });
        var marker = new google.maps.Marker({
          position: company,
          map: map
        });
      }
      </script>
  </div>
</div>
<script>

// Accordion 펼치기 (Product 펼치기)
function clickProductMenu() {
    var x = document.getElementById("demoAcc");
    //if (x.className.indexOf("w3-show") == -1) {     // clickProductMenu가 호출되었을 때, 창이 닫혀있으면 (즉, w3-show가 클래스 이름으로 등록이 안 되어 있으면) w3-show 속성을 추가한다.
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      }
    //} else {
  //      x.className = x.className.replace(" w3-show", "");    // 창이 열려있으면, w3-show 클래스를 지운다.
    //}
}
function clickAnotherMenu() {               // Product가 아닌 다른 메뉴를 클릭했을 때 함수
var x = document.getElementById("demoAcc");
if (x.className.indexOf("w3-show") != -1) {
  x.className = x.className.replace(" w3-show", "");    // 창이 열려있으면, w3-show 클래스를 지운다.
  $('.semiLabelBorder >a').removeClass("activeSemiLabel");  // Product의 세부 메뉴들 하이라이팅 되어있던 것도 초기화
}
}

</script>

</body>
</html>
