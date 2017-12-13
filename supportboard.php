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

img {
  border: 0px;
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

<body class="w3-content" style="max-width:1280px; background-color:white;">

<!-- Sidebar/menu -->
<?php include("include/sidebar.php"); ?>

<!-- !PAGE CONTENT! -->
<div class="" style="margin-left:250px">

  <!-- 여기부터 본문 레이아웃 폼 -->
  <div id=bodyContent style="background-color:white; min-height: 1000px; width: 1030px">
    <?php
      // 디비 소환
      $num = $_GET['name'];
      $query = "SELECT * FROM wow_support where no = $num order by no desc";
      $result = $mysqli->query($query);
      $cnt=0;

      $data = mysqli_fetch_array($result)
    ?>
    <!-- Support 페이지 -->
      <div class="w3-panel w3-padding w3-xlarge" style="background-color:white;color:black;margin:0px;max-height:150px">
          <h2 class="w3-padding"><b>SUPPORT</b></h2>
      </div>

      <!-- 여기에 Support를 작성해 주세요 -->
      <div style="position: relative; margin: 32px 0px 0px 32px; width: 958px; min-height: 700px;">
          <div>
          <form action="support.php" method="get">
            <?php
              $cnt = $_GET['cnt'];
              $cnt = $cnt+1;
            ?>
            <div style="display: inline-block"><input name="searchName" type="text" class="w3-round" placeholder="Search"><button><img src="img/search_icon.png" type="submit"/></button></div>
            <?php if($_SESSION['is_login'] && $_SESSION['type']==0) {
              ?>
            <div style="display: inline-block" class="w3-right">
              <img class="w3-right" src="img/delete_btn_1_basic.png"  onmouseover="this.src='img/delete_btn_2_hover.png'" onmouseout="this.src='img/delete_btn_1_basic.png'" onclick="this.src='img/delete_btn_3_pressed.png'; location.href='supportDelete.php?name=<?= $num ?>'"/>
              <img class="w3-right" src="img/setting_btn_1_basic.png" onmouseover="this.src='img/setting_btn_2_hover.png'" onmouseout="this.src='img/setting_btn_1_basic.png'" onclick="this.src='img/setting_btn_3_pressed.png'; location.href='supportEdit.php?name=<?= $num ?>&cnt=<?=$cnt?> '"/>
              <img class="w3-right" src="img/write_btn_1_basic.png" onmouseover="this.src='img/write_btn_2_hover.png'" onmouseout="this.src='img/write_btn_1_basic.png'" onclick="this.src='img/write_btn_3_pressed.png'; location.href='supportWrite.php'"/>
            </div>
            <?php } ?>
          </form>
          </div>

        <div class="" style="width: 100%; min-height: 200px; margin-top: 16px; border-top-style: solid; border-top-color: #ff8400; background-color: white">
          <div style="padding-left: 20px; padding-right: 20px; word-break:break-all;">
            <!-- 여기에 제목, 작성자 등 게시글 정보를 입력 -->

            <!-- 0713  조회수 추가-->
            <?php
            $query = "update wow_support set hit = hit+1 where no = $num ";
            $result = $mysqli->query($query);
            ?>
            <p style="color: black; display: inline-block "><b> <?php echo   $data['title'];?> </b> | 관리자 </p>
            <p class="w3-right" style="display: inline-block"><?php echo   $data['regdate'];?> | 조회수 <?php  echo $data['hit'];?></p>
          </div>
          <div class="w3-white" style="width: 100%; min-height: 548px; padding: 16px; word-break:break-all;">
            <!-- 첨부파일 표시되는 영역 (있으면 출력) -->
            <?php if($data['file']) { ?>
              <a href="filedownload.php?file_name=<?=urlencode($data['file'])?>"><img src='img/clip_icon.png'/><?php echo $data['file'] ?></a>
              <?php echo "<hr style='border: dotted 1px #c7c7c7'/>";
             } ?>
              <!-- 본문이 표시되는 영역 -->
              <p><?php echo  $data['content'];?></p>
            </div>



        <div class="w3-center">
          <!--   이전글 다음글 수정 완료 ---->

           <?php
           $cnt = $_GET['cnt'];
           $cnt = $cnt+1;
           $query = "SELECT * FROM wow_support where no < '$num' order by no desc";
           $result = $mysqli->query($query);
           $data = mysqli_fetch_array($result);
           $num1 = $data['no'];
           if($num1 != NULL){
           ?>
           <button onmouseover="this.style='background-color: white; color: black'" onmouseout="this.style='default'" onclick="location.href='supportboard.php?name=<?=$num1?>&cnt=<?=$cnt?> '"><b><</b> 이전글</button>
           <?php }?>
           <?php
           $query = "SELECT * FROM wow_support where no > '$num' order by no desc";
           $result = $mysqli->query($query);
           while($data2 = mysqli_fetch_array($result))
           {  $num2 = $data2['no'];}
           if($num2 != NULL){
           ?>
           <button onmouseover="this.style='background-color: white; color: black'" onmouseout="this.style='default'" onclick="location.href='supportboard.php?name=<?=$num2?>&cnt=<?=$cnt?> '"><b>></b> 다음글</button>
           <?php } ?>
           <button onmouseover="this.style='background-color: white; color: black'" onmouseout="this.style='default'" onclick="history.go(-<?php echo "$cnt" ?>)">목록</button>
         </div>
         <!-- 이전글 다음글 수정 완료 ---->

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
