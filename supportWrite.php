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
<script type="text/javascript" src="./nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
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
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
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
<nav class="w3-sidebar w3-bar-block w3-top" style="width:250px;background-color:#2c2d32;overflow:hidden" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <?php if (!$_SESSION['is_login']) {
    echo "<script>location.replace('index.php');</script>";

   }
    if ($_SESSION['is_login']) { ?>
      <center><a href="admin.php"><img src="img/wow.png" alt="wow.png" style="width:60%"/></a></center>
      <?php } else { ?>
    <center><a href="index.php"><img src="img/wow.png" alt="wow.png" style="width:60%"/></a></center>
    <?php } ?>
  </div>

  <div class="w3-padding-16 w3-large w3-text-white sideBarLabel" style="height:80%;overflow:auto">
    <a onclick="clickAnotherMenu()" id="aboutUsPage" href="aboutus.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>About Us</b></a>
    <a onclick="clickProductMenu()" id="productPage" href="javascript:void(0)" class="w3-button w3-block w3-left-align w3-hover-none w3-hover-text-grey w3-padding-16" id="myBtn">
      <b>Products</b>
      <?php $count = "SELECT count(no) FROM wow_subtable";
      $countResult = $mysqli->query($count);
      $temp = mysqli_fetch_array($countResult);
      $totalsCount = $temp[0];
      ?>
      <span class="w3-tag w3-round-xxlarge w3-right" style="background-color: #ff6600; color:white;"><?php echo "$totalsCount" ?></span>
    </a>
    <?php if ($_SESSION['is_login']) { ?>
    <center><a href="#" class="button special" onclick="window.open('editProduct.php', '_blank', 'scrollbars=yes width=550 height=400')">Product 세부 항목 수정</a></center>
    <? } ?>
    <div id="demoAcc" class="w3-hide w3-animate-top semiLabel">
      <?php
      $query = "SELECT * FROM product";  //desc 내림차순   ASC 오름차순
      $result = $mysqli->query($query);
      $cnt=1;
      while($data = mysqli_fetch_array($result)) {
      ?>
      <?php if ($_SESSION['is_login']) { ?>
        <div class="semiLabelBorder"><a href="productadmin.php?product_type=<?=urlencode("$data[product_id]")?>" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey" style="font-size: 14px"><?php echo "$data[product_id]"?></a></div>
      <?php } else { ?>
        <div class="semiLabelBorder"><a href="product.php?product_type=<?=urlencode("$data[product_id]")?>" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey" style="font-size: 14px"><?php echo "$data[product_id]"?></a></div>
      <?php } ?>      <?php
        $cnt++;
      }?>
    </div>
    <a onclick="clickAnotherMenu()" id="supportPage" href="support.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>Support</b></a>
    <a onclick="clickAnotherMenu()" id="contactUsPage" href="contactus.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>Contact Us</b></a>
  </div>
  <?php if ($_SESSION['is_login']) { ?>
    <center><button style="color:white; background-color:#2c2d32;" class="w3-button w3-large" onclick="location.href='logout.php'" type="button">ADMIN LOGOUT</button></center>
    <center><button style="color:white; background-color:#2c2d32;" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-large">관리자 비밀번호 변경</button></center>
  <? } ?>
  <div style="text-align: center"><p style="color:#ffffff">ⓒ 2017 WOWSYSTEM Co., Ltd.</p></div>
</nav>

<!-- !PAGE CONTENT! -->
<div class="" style="margin-left:250px">

  <!-- Top header -->
  <form method="get" action="search.php" name="searchform">
  <header class="w3-container w3-xlarge" style= "background-color:#2c2d32;color:#cccccc;padding:0px">
    <div class="w3-container w3-display-container" style="width:1030px;height:100px;padding:0px;margin:0px">
      <p class="w3-left" style="font-size:18px;line-height:100px;margin:0px;padding-left:30px">Passion has a magical quality to it.</p>
    <div class="w3-container w3-display-right w3-third" style="height:100px;background-color:#222222;margin:0px">
      <div class="w3-display-left w3-padding">
        <a href="javascript:document.searchform.submit();"><span style="font-size:18px; color:#cccccc" class="fa fa-search"></span></a>
        <input class="w3-border-0" style="background-color:#222222;color:#cccccc;width:80%;height:22px;font-size:18px;" type="text" placeholder="Search Your Product" name="input_search">
      </div>
    </div>
    </div>
  </header>
  </form>

  <!-- 여기부터 본문 레이아웃 폼 -->
  <div id=bodyContent style="background-color:#f4f7fa; height: 1000px; width: 1030px">

    <!-- Support 페이지 -->
      <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;margin:0px;max-height:150px">
          <h2 class="w3-padding"><b>SUPPORT</b></h2>
      </div>


      <!-- 여기에 Support를 작성해 주세요 -->
      <!-- 네이버 에디터 호출 -->
      <div style="position: relative; margin: 32px 0px 0px 32px; width: 958px; height: 700px;">
        <div>
          <?php if($_SESSION['is_login']) { ?>
          <form name="nse" action="add_db_nse.php" enctype='multipart/form-data' method="post">
              <input type='text' name='title' size='30' placeholder='제목 입력' style="width: 900px"/>
              <textarea name="ir1" id="ir1" class="nse_content" style="width: 900px; height: 500px" ></textarea>

                <script type="text/javascript">
                  var oEditors = [];
                  nhn.husky.EZCreator.createInIFrame({
                    oAppRef: oEditors,
                    elPlaceHolder: "ir1",
                    sSkinURI: "./nse_files/SmartEditor2Skin.html",
                    fCreator: "createSEditor2"
                  });
                  function submitContents(elClickedObj) {
                    // 에디터의 내용이 textarea에 적용됩니다.
                    oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
                    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                try {
                  elClickedObj.form.submit();
                } catch(e) {}
              }
   </script>


        <input type="file" size="30" name="support_file"/>
       <input type="submit" value="전송" onclick="submitContents(this)" />
       <a href="javascript:history.back()">뒤로가기</a>
   </form>
          <?php } ?>
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

</script>

</body>
</html>
