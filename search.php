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
.productImgStyle{
  background-color: #d4ecf7;
    width:100%;
}

.productNoImgStyle{
  background-color: #d4ecf7;

    width:80%;
    height:50%;

}

.productName{
background-color:#e6e9ed;
color: #2c2d32;
}

.buttonForContents{
color:white;
background-color: rgba( 255, 255, 255, 0 );

}

#imgDiv2 {
  width:  60px;
  height: 60px;
  position:   absolute;
}

#imgDiv2 img {
  width:  50px;
  height: 50px;
  position:   absolute;
}

#imgDiv2 > #selectHover {
    opacity:    0;
    transition: opacity 1s
}

#imgDiv2:hover > #selectHover {
    opacity:    1;
}
.productImage
{
    width:100%;
    background-color: #d4ecf7;
    height:200px;
}

#page_1{font-family:굴림,돋음,sans-serif; font-size:13px; font-weight:normal; color:#676460; text-align:center;
line-height:20px;
margin:30px;
}
#font1{font-family:굴림,돋음,sans-serif; font-size:15px; font-weight:bold; color:#676460; text-align:center;  float:left;
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
  <?php
    $inputSearchData = $_REQUEST['input_search'];       // input_search 받아옴.
    if ($inputSearchData == "admin") {          // 만약에 검색창에 'admin' 입력했으면 바로 admin 페이지로 이동
    if(!$_SESSION['is_login'])
    {
    ?>
<div id='id02' class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; background-color:#2c2d32;">
      <form class="w3-container" form action="login.php" method="POST">
        <div class="w3-section">
          <label style="color:white;"><b>Admin ID</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter ID" name="inputid" required>
          <label style="color:white;"><b>Admin Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter PW" name="inputpw" required>
          <button class="w3-left w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:#ff8400; color:white;" type="submit"><b>Login</b></button>
          <button onclick="history.go(-1)" type="button" class="w3-right w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:#ff8400; color:white;"><b>Cancel</b></button>
        </div>

      </form>
    </div>
  </div>
 <?php

echo "<script>document.getElementById('id02').style.display='block'</script>";

    }
    else{
      echo "<script>history.go(-1);</script>";
    }
    }
   ?>


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
    <?php if ($_SESSION['is_login']) { ?>
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
  <form method="get" action="search.php">
  <header class="w3-container w3-xlarge" style= "background-color:#2c2d32;color:#cccccc;padding:0px">
    <div class="w3-container" style="width:1030px;height:100px;padding:0px;margin:0px">
      <p class="w3-left" style="font-size:18px;line-height:100px;margin:0px;padding-left:30px">Passion has a magical quality to it.</p>
    <div class="w3-container w3-right w3-third" style="height:100px;background-color:#222222;margin:0px">
      <p style="color:#878787; margin:0px; line-height:100px">
        <span style="font-size:18px" class="fa fa-search">
        <input class="w3-border-0" style="background-color:#222222;color:#cccccc;width:80%;font-size:18px;" type="text" placeholder="Search Your Product" name="input_search">
      </span>
      </p>
    </div>
    </div>
  </header>
  </form>

  <!-- 여기부터 본문 레이아웃 폼 -->
  <!-- 홈 페이지에 뜨는 New Product 화면 -->

  <div id=bodyContent>
  <div id=newProductPage>
  <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;margin:0px;max-height:150px">
    <h2 class="w3-padding">SEARCH Result of <b>'<?php echo $inputSearchData; ?>'</b></h2>
  </div>

  <div class="w3-container" style="height:1000px;background-color:#f4f7fa;padding:0px">
    <!-- 여기에 내용을 채워넣으면 됩니다. -->


<!-- Product grid -->
<div class="w3-container" style="width:1030px; background-color:#f4f7fa;">
    <div class="w3-row-padding w3-grayscale w3-margin-top">

      <?php
      $_page=$_GET[_page];
       $view_total = 9; //한 페이지에 9개 게시글이 보인다.
       if(!$_page)($_page=1); //페이지 번호가 지정이 안되었을 경우
       $page= ($_page-1)*$view_total;

      $query = "SELECT count(no) FROM wow_subtable WHERE product_title LIKE '%$inputSearchData%' OR product_name LIKE '%$inputSearchData%' OR product_subname LIKE '%$inputSearchData%'";  //desc 내림차순   ASC 오름차순
      $result = $mysqli->query($query);
      $temp = mysqli_fetch_array($result);
      $totals = $temp[0];

      $query = "SELECT * FROM wow_subtable WHERE product_title LIKE '%$inputSearchData%' OR product_name LIKE '%$inputSearchData%' OR product_subname LIKE '%$inputSearchData%' ORDER BY product_name,no desc limit $page, $view_total";  //desc 내림차순   ASC 오름차순
      $result = $mysqli->query($query);
      $cnt=1;
      while($data = mysqli_fetch_array($result)) {
$textMain=mb_strimwidth($data[product_name], '0', '30', '...', 'utf-8');
        $textSub=mb_strimwidth($data[product_subname], '0', '30', '...', 'utf-8');

      ?>

        <div class="w3-col l4 s6 w3-margin" style="width:30%; max-height:270px">
            <div class="productName w3-container w3-border" style="height:70px;">
              <?php if ($_SESSION['is_login']) { ?>
              <button type="button" onclick="window.open('product_maintableedit.php?name=<?=urlencode($data[product_name])?>','_blank', 'scrollbars=yes width=550 height=400')">수정</button>
              <button type="button" onclick="location.href='deletitem.php?name=<?=urlencode($data[product_name])?>'">삭제</button><br>
              <?php }?>
              <p><b><?php echo "$textMain"?></b><br>
                <?php if ($textSub) { ?>
                <?php echo "($textSub)"; ?>
                <?php } ?>
              </p>
            </div>
            <div class="productImage w3-display-container w3-border">
<?php if($data[product_picture]==NULL)
            {
              echo "<img class='productNoImgStyle w3-display-middle' src = 'img/camera.png'>";
            }
             else
             {

               echo "<img class='productImgStyle' style='height:200px' src = 'img/$data[product_picture]'>"; }?>
                    <div class="w3-display-middle w3-xlarge">
                        <div id="imgDiv2" class="w3-display-middle">
                        <img id="selectBtn" src="img/moreview_btn_1_basic.png">
                        <img id="selectHover" src="img/moreview_btn_2_hover.png" onclick="location.href='contents.php?product_no=<?="$data[no]"?>'">
                      </div>
                      </div>
            </div>
        </div>
        <?php
           $cnt++;
          }?>
    </div>
</div>



      <!-- Pagination -->

      <div id='page_1'>
      <?
      //총게시물                 $totals
      //한페이지 나타날 게시글수 $view_total
      $rr=ceil($totals/$view_total);


      //이전 페이지 구하기
      $before= $_page-1; //현재 페이지수 에서 -1을 준다.
      if($before<1)($before=1);

      //다음 페이지 구하기
      $next= $_page + 1;
      if($next>$rr)($next=$rr);


      //그룹페이지 구성//
      //(처음)
      if($_page%10){$goto=$_page-$_page%10+1; //한 그룹당 10개 페이지를 지정 '10'을 넘기면 1을 증가.
       }elseif($goto=$_page -9); // '10'배수가 아니면 -'9'

      //(끝)

      //그룹페이지 구성 (끝)//
      $last= $goto + 10; //예) $goto='1'이라면 $last='11'이 되어야 합니다.

      //이전페이지 그룹 출력
      $before_group= $before;
      if($before_group<1)($before_group=1);
      if($_page !=1)
      ?>
      <button style="background-color: white; color: #555555" onmouseover="this.style='background-color: #ff8400; color: #555555'" onmouseout="this.style='background-color: white; color: #555555'" onclick="javascript:onPrevClicked();"><b><</b></button>
      <?php


      //페이지 번호 출력
      for($e=$goto; $e<$last; $e++){ //현재페이지가 전체페이지 보다 작으면 페이지를 증가
      if($e>$rr) break; //총 나타날 페이지 번호 보다 크면 멈추고 다음을 실행.
      if($e==$_page) { //$e 와 $_page번호가 서로 같으면....
      ?>
      <button style="background-color: white; color: #ff8400"><b><?php echo $e ?></b></button>
      <?php
      }
                 else{
             ?>
          <button style="background-color: white; color: #555555" onmouseover="this.style='background-color: #ff8400; color: #555555'" onmouseout="this.style='background-color: white; color: #555555'" onclick="location.href='search.php?input_search=<?=urlencode("$inputSearchData")?>&_page=<?=$e.$href?>'"><b><?php echo $e?></b></button>
             <?php
           }
      }


      //다음페이지 그룹 출력
      $next_group= $next;
      if($next_group > $rr)($next_group=$rr); //$next_group는 $rr보다 크면 $rr은 $next_group가 된다.
      if($_page !=$rr)
      ?>
      <button style="background-color: white; color: #555555" onmouseover="this.style='background-color: #ff8400; color: #555555'" onmouseout="this.style='background-color: white; color: #555555'" onclick="javascript:onNextClicked();"><b>></b></button>
      <!--<button onmouseover="this.style='background-color: #ff8400; color: #cccccc'" onmouseout="this.style='default'" onclick="this.style='color:#ff8400'">숫자</button>-->
      </div>



      <!-- 여기까지 내용을 채워넣으면 됩니다. -->
  </div>
</div>

  <!-- About Us 페이지 -->

  <!-- Product 페이지 -->

  <!-- Support 페이지 -->

  </div>
</div>
<script>
function onNextClicked()
{
  //console.log("<?php echo $PHP_SELF.'?_page='.$next_group.$href; ?>");

  location.href="<?php echo $PHP_SELF.'?input_search='.urlencode($inputSearchData).'&_page='.$next_group.$href; ?>";
}

function onPrevClicked()
{
  //console.log("<?php echo $PHP_SELF.'?_page='.$next_group.$href; ?>");

  location.href="<?php echo $PHP_SELF.'?input_search='.urlencode($inputSearchData).'&_page='.$before_group.$href; ?>";
}


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
