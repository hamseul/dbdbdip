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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
.w3-sidebar a {font-family: "Open Sans", "Nanum Gothic", sans-serif}
body,p,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Open Sans", "Nanum Gothic", sans-serif;}

td, th {
  text-align: "center";
}

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
  $('#supportPage').addClass("activeFont");     // 해당 메뉴의 초기 상태는 항상 하이라이팅

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

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Top header -->
<?php include("include/topheader.php"); ?>

  <!-- 여기부터 본문 레이아웃 폼 -->
  <div id=bodyContent style="background-color:#f4f7fa; height: 1000px;">

    <!-- Support 페이지 -->
      <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;margin:0px;max-height:150px">
          <h2 class="w3-padding"><b>SUPPORT</b></h2>
      </div>


      <!-- 여기에 Support를 작성해 주세요 -->
      <div style="position: relative; margin: 32px 0px 0px 32px; width: 958px; height: 700px;">
        <div>
          <input type="text" class="w3-round" placeholder="Search"><img src="img/search_icon.png" type="submit"/>
          <?php if($_SESSION['is_login']) { ?>
            <a href="supportWrite.php"><img class="w3-right" src="img/write_btn_1_basic.png" onmouseover="this.src='img/write_btn_2_hover.png'" onmouseout="this.src='img/write_btn_1_basic.png'" onclick="this.src='img/write_btn_3_pressed.png'"/></a>
          <?php } ?>
        </div>
        <table class="w3-table w3-bordered" style="margin-top: 16px; border-top-style: solid; border-top-color: #ff8400; border-bottom-style: solid; border-bottom-color: #ff8400">
          <tr>
            <th style="width: 120px">&nbsp;</th>
            <th style="text-align: center">제목</th>
            <th style="width: 120px; text-align: center">작성자</th>
            <th style="width: 140px; text-align: center">작성일</th>
            <th style="width: 100px; text-align: center">조회</th>
          </tr>

          <?php
            /* 디비 호출 */

            $searchName = $_GET['searchName'];
            $query = "SELECT * FROM wow_support where title like '%$searchName%'";
            $result = $mysqli->query($query);

            while($data = mysqli_fetch_array($result)) {
          ?>
          <tr onclick="location.href='supportboard.php?name=<?= $data['no'] ?> '" style="cursor:pointer">
            <td style="text-align: center">  <?php echo  $data['no'];?></td>
            <td>  <?php echo   $data['title'];?></td>
            <?php $timestamp = $data['regdate']; ?>
            <td style="text-align: center">  <?php echo substr($timestamp,0,10);?></td>
            <td style="text-align: center">관리자</td>
            <td style="text-align: center">    <?php echo   $data['hit'];?></td>
          </tr>
          <?php } ?>

        </table>

        <div style= "position: absolute; bottom: 0px; left: 42%;">
          <button onmouseover="this.style='background-color: #ff8400; color: #cccccc'" onmouseout="this.style='default'" onclick="this.style='color:#ff8400'"><</button>
          <button onmouseover="this.style='background-color: #ff8400; color: #cccccc'" onmouseout="this.style='default'" onclick="this.style='color:#ff8400'">1</button>
          <button onmouseover="this.style='background-color: #ff8400; color: #cccccc'" onmouseout="this.style='default'" onclick="this.style='color:#ff8400'">2</button>
          <button onmouseover="this.style='background-color: #ff8400; color: #cccccc'" onmouseout="this.style='default'" onclick="this.style='color:#ff8400'">3</button>
          <button onmouseover="this.style='background-color: #ff8400; color: #cccccc'" onmouseout="this.style='default'" onclick="this.style='color:#ff8400'">></button>
        </div>

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

// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
