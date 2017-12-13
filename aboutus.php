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

.container {
    position: relative;
}

img {
    width: 1030px;
    height: auto;
}

</style>
<script type='text/javascript'>
$(document).ready(function(){
  $('#aboutUsPage').addClass("activeFont");     // 해당 메뉴의 초기 상태는 항상 하이라이팅

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

<!-- Sidebar/menu -->
<?php include("include/sidebar.php"); ?>


<!-- !PAGE CONTENT! -->
<div class="" style="margin-left:250px">

  <!-- Top header -->
<?php include("include/topheader.php"); ?>

<!-- 여기부터 본문 레이아웃 폼 -->
<div id=bodyContent style="height: 1000px">
  <!-- About Us 페이지 -->
  <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;width:1030px;margin:0px;">
    <h2 class="w3-padding"><b>About</b> Us</h2>
  </div>
  <div class="">
    <div class="w3-padding" style="line-height: 120px; background-image: url('img/about_us_banner.jpg'); width: 1030px">
      <h2 class="w3-padding" style="color: #ffffff; margin: 0px"><b>와우시스템</b>에 오신 것을 환영합니다.</h2>
    </div>
  <!-- 여기에 About Us를 작성해 주세요 -->
    <div class="w3-container" style="width:1030px; min-height:870px; height:100%; background-color:#f4f7fa; padding-left:32px; padding-top:16px;">
      <?php
      $query = "SELECT * FROM wow_aboutus";  //desc 내림차순   ASC 오름차순
      $result = $mysqli->query($query);
      $data = mysqli_fetch_array($result)
      //이 곳에 소개를 작성해주세요
      ?>
      <p><?php echo "$data[0]"; ?> </p>

    <?php if ($_SESSION['is_login']) { ?>
        <img class="w3-right" src="img/setting_btn_1_basic.png" onmouseover="this.src='img/setting_btn_2_hover.png'" onmouseout="this.src='img/setting_btn_1_basic.png'" onclick="this.src='img/setting_btn_3_pressed.png'; location.href='aboutusEdit.php'" style="width: 80px;"/>
      <?php } ?>

    </div>
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
