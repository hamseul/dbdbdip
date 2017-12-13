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
background-color:white;
color: black;
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
  <div id=bodyContent style="background-color:white; width:1030px; height: 1000px;">

    <!-- Support 페이지 -->
      <div class="w3-panel w3-padding w3-xlarge" style="background-color:white;color:black; width:1030px; margin:0px;max-height:150px">
          <h2 class="w3-padding"><b>SUPPORT</b></h2>
      </div>


      <!-- 여기에 Support를 작성해 주세요 -->
      <div class="w3-padding" style="position: relative; width:1030px; height: 800px;">
        <div style="margin-left:32px; margin-top:32px;">
          <form action="support.php" method="get">
            <div style="display: inline-block"><input name="searchName" type="text" class="w3-round" placeholder="Search"><button><img src="img/search_icon.png" type="submit"/></button></div>
            <?php if($_SESSION['is_login'] && $_SESSION['type']==0) { ?>
            <div style="display: inline-block" class="w3-right">
              <img class="w3-right" src="img/write_btn_1_basic.png" onmouseover="this.src='img/write_btn_2_hover.png'" onmouseout="this.src='img/write_btn_1_basic.png'" onclick="this.src='img/write_btn_3_pressed.png'; location.href='supportWrite.php'"/>
            </div>
            <?php } ?>
          </form>
        </div>
        <table class="w3-table w3-bordered" style="width:950px; margin-top: 16px; border-top-style: solid; border-top-color: #ff8400; border-bottom-style: solid; border-bottom-color: #ff8400; margin-left:32px; margin-right:32px;">
          <tr>
            <th style="width: 80px;">&nbsp;</th>
            <th style="width: 400px; text-align: center">제목</th>
            <th style="width: 130px; text-align: center">작성일</th>
            <th style="width: 90px; text-align: center">작성자</th>
            <th style="width: 90px; text-align: center">조회</th>
          </tr>

          <?php
          // $query1 = "SET @COUNT = 0";
          // $query2 = "UPDATE wow_support SET no = @COUNT:=@COUNT+1";
          // $result1 = $mysqli->query($query1);
          // $result2 = $mysqli->query($query2);


            /* 디비 호출 */
             $_page=$_GET[_page];
            $view_total = 15; //한 페이지에 15개 게시글이 보인다.
            if(!$_page)($_page=1); //페이지 번호가 지정이 안되었을 경우
            $page= ($_page-1)*$view_total;

            $query = "SELECT count(no) FROM wow_support";
            $result = $mysqli->query($query);
            $temp= mysqli_fetch_array($result);
            $totals= $temp[0];

            $searchName = $_GET['searchName'];
            $query = "SELECT * FROM wow_support where title like '%$searchName%'  ORDER BY no desc limit $page, $view_total";
            $result = $mysqli->query($query);
            $cnt = 0;

            $query2 = "SELECT count(*) from wow_support";
            $result2 = $mysqli->query($query2);
            $temp2 = mysqli_fetch_array($result2);
            $i =$temp2[0];

            while($data = mysqli_fetch_array($result)) {
          ?>
          <tr onclick="location.href='supportboard.php?name=<?= $data['no'] ?>&cnt=<?=$cnt ?> '" style="cursor:pointer">
            <td style="text-align: center">  <?php echo  "$i"; ?></td>
            <?php $text=mb_strimwidth($data['title'], '0', '60', '...', 'utf-8'); ?>
            <td>  <?php echo "$text";?>

            <?php $check_time=(time()-$data[reg_date])/60/60;
            if($check_time<=168)    // support 게시판에 NEW 표시가 되어 있을 기준 시간 ex) 24시간 * 7일 = 168으로 설정
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<span class="w3-round-xlarge" style="color:black; background-color:white; font-size:10px; padding:2px;">NEW</span>
            </td>

            <?php $timestamp = $data['regdate']; ?>
            <td style="text-align: center">  <?php echo substr($timestamp,0,10);?></td>
            <td style="text-align: center">관리자</td>
            <td style="text-align: center">    <?php echo   $data['hit'];?></td>
          </tr>
          <?php $i--;} ?>

        </table>


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

      </div>
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

</script>

</body>
</html>
