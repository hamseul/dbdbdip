<?php
  include_once("db_config.php");
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
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=rJuAiWyZX77hlkRwfZ1K&submodules=geocoder"></script>
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

table, tr, td{margin:0px;}

#page_1{font-family:굴림,돋음,sans-serif; font-size:13px; font-weight:normal; color:#676460; text-align:center;
line-height:20px;
margin:30px;
}
#font1{font-family:굴림,돋음,sans-serif; font-size:15px; font-weight:bold; color:#676460; text-align:center;  float:left;
}


</style>
<script type='text/javascript'>
$(document).ready(function(){
  $('#productLabel').addClass("activeFont");

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

<body class="w3-content" style="max-width:1280px">
  <?php

    $productCategory = $_REQUEST['product_type'];
   ?>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-top" style="z-index:3;width:250px;background-color:#2c2d32" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <center><a href="index.php"><img src="img/wow.png" alt="wow.png" style="width:60%"/></a></center>
  </div>

  <div class="w3-padding-16 w3-large w3-text-white sideBarLabel" style="height:80%;overflow:auto">
    <a onclick="clickAnotherMenu()" name="aboutUsPage" href="aboutus.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16">About Us</a>
    <a onclick="clickProductMenu()" id="productLabel" href="javascript:void(0)" class="w3-button w3-block w3-left-align w3-hover-none w3-hover-text-grey w3-padding-16" id="myBtn">
      Products
      <?php $count = "SELECT count(no) FROM wow_subtable";
      $countResult = $mysqli->query($count);
      $temp = mysqli_fetch_array($countResult);
      $totalsCount = $temp[0];
      ?>
      <span class="w3-tag w3-round-xxlarge w3-right" style="background-color: #ff6600; color:white;"><?php echo "$totalsCount" ?></span>
    </a>
    <div id="demoAcc" class="semiLabel">
      <?php
      $query = "SELECT * FROM product";  //desc 내림차순   ASC 오름차순
      $result = $mysqli->query($query);
      $cnt=1;
      while($data = mysqli_fetch_array($result)) {
        if ($data['product_id'] == $productCategory)
        { ?>
          <div class="semiLabelBorder"><a id="<?php $data['product_title']?>" href="product.php?product_type=<?=urlencode("$data[product_id]")?>" onclick="currentClickMenu()" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey activeSemiLabel"><?php echo "$data[product_id]"?></a></div>
        <?php } else { ?>
          <div class="semiLabelBorder"><a id="<?php $data['product_title']?>" href="product.php?product_type=<?=urlencode("$data[product_id]")?>" onclick="currentClickMenu()" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey"><?php echo "$data[product_id]"?></a></div>
        <?php  }  ?>
      <?php
        $cnt++;
      }?>
    </div>
    <a onclick="clickAnotherMenu()" href="support.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16">Support</a>
    <a onclick="clickAnotherMenu()" name="contactUsPage" href="contactus.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16">Contact Us</a>
  </div>

  <div style="text-align: center"><p style="color:#ffffff">ⓒ 2017 WOWSYSTEM Co., Ltd.</p></div>
</nav>

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
  <div id=newProductPage class="menuClass">
  <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;margin:0px;max-height:150px">
    <h2 class="w3-padding">Product&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;<?php echo "<b>$productCategory</b>"; ?></h2>
  </div>

  <div class="w3-container" style="height:960px;background-color:#f4f7fa;padding:0px">
    <!-- 여기에 내용을 채워넣으면 됩니다. -->


<!-- Product grid -->
<div class="w3-container" style="width:1030px; background-color:#f4f7fa;">
    <div class="w3-row-padding w3-grayscale w3-margin-top">

      <?php
      $_page=$_GET[_page];
            $view_total = 6; //한 페이지에 6개 게시글이 보인다.
            if(!$_page)($_page=1); //페이지 번호가 지정이 안되었을 경우
            $page= ($_page-1)*$view_total;

            $query = "SELECT count(product_name) FROM wow_subtable WHERE product_title='$productCategory'";
            $result = $mysqli->query($query);
            $temp= mysqli_fetch_array($result);
            $totals= $temp[0];

      $query = "SELECT * FROM wow_subtable WHERE product_title='$productCategory' ORDER BY product_name,no desc limit $page, $view_total";  //desc 내림차순   ASC 오름차순
      $result = $mysqli->query($query);
      $cnt=1;

      while($data = mysqli_fetch_array($result)) {
      ?>
        <div class="w3-col s2 m3 l4 w3-margin" style="width:30%; height:270px">
            <div class="productName w3-container w3-border">
              <p><b><?php echo "$data[product_name]"?></b>
              (<?php echo "$data[product_subname]"?>)
              </p>
            </div>
            <div class="productImage w3-display-container w3-border">
                <?php echo "<img class='productImgStyle' src = 'img/$data[product_picture]'>"?>
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
          <button style="background-color: white; color: #555555" onmouseover="this.style='background-color: #ff8400; color: #555555'" onmouseout="this.style='background-color: white; color: #555555'" onclick="location.href='<?php echo $PHP_SELF.'?product_type='.$productCategory.$href.'&_page='.$e.$href; ?>'"><b><?php echo $e?></b></button>
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

  <!-- About Us 페이지 -->

  <!-- Product 페이지 -->

  <!-- Support 페이지 -->

  </div>
</div>
<script>

function onNextClicked()
{
  //console.log("<?php echo $PHP_SELF.'?_page='.$next_group.$href; ?>");

  location.href="<?php echo $PHP_SELF.'?product_type='.$productCategory.$href.'&_page='.$next_group.$href; ?>";
}

function onPrevClicked()
{
  //console.log("<?php echo $PHP_SELF.'?_page='.$next_group.$href; ?>");

  location.href="<?php echo $PHP_SELF.'?product_type='.$productCategory.$href.'&_page='.$before_group.$href; ?>";
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

function currentClickMenu() {
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
