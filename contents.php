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


.productImg{
  background-color:white;
  margin-left:44px;
  margin-right:44px;
  padding:30px;
  width:100%;
}

  #p2{
  background-color:#ffffff;
  color:#2c2d32;
  margin:30px;
   list-style: disc;
  padding-left:16px;
  }


#imgDiv {
    width:  40px;
    height: 40px;
    position:   absolute;
}


#imgDiv img {
    width:  30px;
    height: 30px;
    position:   absolute;
    left:   50%;
    top:    50%;
    margin-left:    -25px;
    margin-top:     -15px;
}



#imgDiv > #closeHover {
    opacity:    0;
    transition: opacity 1s
}

#imgDiv:hover > #closeHover {
    opacity:    1;
}

</style>
<script type='text/javascript'>
$(document).ready(function(){

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
    <center><a href="index.php"><img src="img/wow.png" alt="wow.png" style="width:60%"/></a></center>
  </div>

  <div class="w3-padding-16 w3-large w3-text-white sideBarLabel" style="height:80%;overflow:auto">
    <a onclick="clickAnotherMenu()" name="aboutUsPage" href="aboutus.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>About Us</b></a>
    <a onclick="clickProductMenu()" name="productPage" href="javascript:void(0)" class="w3-button w3-block w3-left-align w3-hover-none w3-hover-text-grey w3-padding-16" id="myBtn">
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
        <div class="semiLabelBorder"><a href="productadmin.php?product_type=<?=urlencode("$data[product_id]")?>" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey"><?php echo "$data[product_id]"?></a></div>
      <?php } else { ?>
        <div class="semiLabelBorder"><a href="product.php?product_type=<?=urlencode("$data[product_id]")?>" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey" style="font-size: 14px"><?php echo "$data[product_id]"?></a></div>
      <?php } ?>      <?php
        $cnt++;
      }?>
    </div>
    <a onclick="clickAnotherMenu()" href="support.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>Support</b></a>
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

  <?php
    $productNumber = $_REQUEST['product_no'];
    $query2="SELECT * FROM wow_subtable WHERE no='$productNumber'";
    $result2= $mysqli->query($query2);
    $temp2= mysqli_fetch_array($result2);
    $productCategory = $temp2[product_title];
    $query="SELECT * FROM wow_specifictable WHERE s_no='$productNumber'";
    $result1= $mysqli->query($query);
  ?>

  <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;width:1030px;margin:0px;height:100%">
    <h2 class="w3-padding">Product&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;<?php echo "<b>$productCategory</b>"; ?></h2>
  </div>

  <!-- Contents -->
  <div class="w3-container" style="width:1030px; min-height:1000px; background-color:#f4f7fa; padding:16px">
      <div class="container1 w3-display-container w3-margin-left w3-margin-right w3-margin-top w3-padding" style="background-color:#e6e9ed; color: #2c2d32;">
        <p><b><?php echo "$temp2[product_name]"?></b>&nbsp;(<?php echo "$temp2[product_subname]";?>)</p>
        <div id="imgDiv" class="w3-display-right">
          <img id="closeBtn" src="img/close_btn_1_basic.png">
          <img id="closeHover" src="img/close_btn_2_hover.png" onclick="history.back(-1);">
        </div>
      </div>
      <div class="w3-padding-large w3-white w3-margin-right w3-margin-left" style="min-height:700px;">
      <?php
      while($data = mysqli_fetch_array($result1)){
        ?>
      <div class="container2 w3-display-container w3-margin-left w3-margin-right" style="background-color:#ffffff; color: #2c2d32;">
        <div class="container3 w3-display-container">

          <div class="w3-row w3-white">
            <?php if($data['product_s_title']) { ?>

                <table class="w3-table" style="max-width:215px; margin-left:65px;">
                  <tr style="max-width:215px;">
                    <th style="background-color:#FFA500; width:196px; padding-left:10px; padding-top:3px; padding-bottom:3px;"><span><strong><?php echo "$data[product_s_title]"?></strong></span>
                    </th>
                    <th style="background-color:#00ACFF; width:19px;"></th>
                  </tr>
                  <?php if ($_SESSION['is_login']) { ?>
                    <a class="w3-right" href="edit.php?idx=<?=$data['s_id']?>"> &nbsp;항목 수정하기 </a>
                    <a class="w3-right" href="deleteTerm.php?idx=<?=$data['s_id']?>"> 항목 삭제하기 | </a>
                  <?php } ?>
                </table>

            <?php } else { ?>
              <?php if ($_SESSION['is_login']) { ?>
                <a class="w3-right" href="edit.php?idx=<?=$data['s_id']?>"> &nbsp;항목 수정하기 </a>
                <a class="w3-right" href="deleteTerm.php?idx=<?=$data['s_id']?>"> 항목 삭제하기 | </a>
              <?php } ?>
            <?php } ?>
          </div>
          <div class="w3-container" style="word-break:break-all;">
            <div id="p2">
              <?php echo $data[product_s_text] ?>
            </div>
          </div>
        </div>
      </div>
  <?php $cnt++;}?>
  </div>
      <?php if ($_SESSION['is_login']) { ?>
      <a href="write.php?idx=<?=$productNumber?>"> 내용 추가하기 </a><span>&nbsp;Tip! 항목의 제목 구분 바를 없애시려면 수정 메뉴에서 제목을 빈칸으로 남겨두시면 됩니다.</span>
      <?php } ?>
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
