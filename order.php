<?php
if(!isset($_SESSION))
  {
    session_start();
  }
  include_once("db_config.php");
  require_once("memberlock.php");
  include("include/session_timer.php");

  $CPU_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = 'CPU'");
  $MainBoard_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = '메인보드'");
  $RAM_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = '메모리'");
  $VGA_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = '그래픽카드'");
  $SSD_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = 'SSD'");
  $HDD_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = 'HDD'");
  $Power_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = '파워'");
  $Case_list = mysqli_query($mysqli,"SELECT * FROM wow_subtable WHERE product_title = '케이스'");
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

<body class="w3-content" style="max-width:1280px; background-color:#white;">

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
<?php include("include/sidebar.php");?>

<!-- !PAGE CONTENT! -->
<div class="" style="margin-left:250px">

  <!-- Top header -->
  <?php include("include/header.php"); ?>

  <!-- 여기부터 본문 레이아웃 폼 -->
  <div>
  <p>
    <div width=800px nowrap align=center>
        <B>부품 선택</B>
    </div>
  </p>
    <form action="./write_update.php" method=post ENCTYPE='multipart/form-data'>
    <table id="selectProduct">
        <tr>
          <td width=150px nowrap align=left >
            <B>CPU</B>
          </td>
          <td align=left width=588px nowrap>
            <select style="width:588px" name="cpuno" id="cpuno">
              <?php
               while($cpu_row = mysqli_fetch_array($CPU_list))
               {
                 $cpu_name = $cpu_row['product_name'];
                 echo "<option value=$cpu_name>" . $cpu_row['product_name'] . "</option>";
               }
               ?>
            </select>
          </td>
      </tr>
      <tr>
        <td width=150px nowrap align=left >
          <B>Mainboard</B>
        </td>
        <td align=left width=588px nowrap>
          <select style="width:588px" name="mbno" id="mbno">
            <?php
             while($mb_row = mysqli_fetch_array($MainBoard_list))
             {
               $mainboard_name = $mb_row['product_name'];
               echo "<option value=$mainboard_name>" . $mb_row['product_name'] . "</option>";
             }
             ?>
          </select>
        </td>
    </tr>
    <tr>
      <td width=150px nowrap align=left >
        <B>RAM</B>
      </td>
      <td align=left width=588px nowrap>
        <select style="width:588px" name="ramno" id="ramno">
          <?php
           while($ram_row = mysqli_fetch_array($RAM_list))
           {
             $ram_name = $ram_row['product_name'];
             echo "<option value=$ram_name>" . $ram_row['product_name'] . "</option>";
           }
           ?>
        </select>
      </td>
  </tr>
  <tr>
    <td width=150px nowrap align=left >
      <B>VGA</B>
    </td>
    <td align=left width=588px nowrap>
      <select style="width:588px" name="vgano" id="vgano">
        <?php
         while($vga_row = mysqli_fetch_array($VGA_list))
         {
           $vga_name = $vga_row['product_name'];
           echo "<option value=$vga_name>" . $vga_row['product_name'] . "</option>";
         }
         ?>
      </select>
    </td>
</tr>
<tr>
  <td width=150px nowrap align=left >
    <B>SSD</B>
  </td>
  <td align=left width=588px nowrap>
    <select style="width:588px" name="ssdno" id="ssdno">
      <?php
       while($ssd_row = mysqli_fetch_array($SSD_list))
       {
         $ssd_name = $ssd_row['product_name'];
         echo "<option value=$ssd_name>" . $ssd_row['product_name'] . "</option>";
       }
       ?>
    </select>
  </td>
</tr>
<tr>
  <td width=150px nowrap align=left >
    <B>HDD</B>
  </td>
  <td align=left width=588px nowrap>
    <select style="width:588px" name="hddno" id="hddno">
      <?php
       while($hdd_row = mysqli_fetch_array($HDD_list))
       {
         $hdd_name = $hdd_row['product_name'];
         echo "<option value=$hdd_name>" . $hdd_row['product_name'] . "</option>";
       }
       ?>
    </select>
  </td>
</tr>
<tr>
  <td width=150px nowrap align=left >
    <B>Power</B>
  </td>
  <td align=left width=588px nowrap>
    <select style="width:588px" name="pwrno" id="pwrno">
      <?php
       while($power_row = mysqli_fetch_array($Power_list))
       {
         $power_name = $power_row['product_name'];
         echo "<option value=$power_name>" . $power_row['product_name'] . "</option>";
       }
       ?>
    </select>
  </td>
</tr>
<tr>
  <td width=150px nowrap align=left >
    <B>Case</B>
  </td>
  <td align=left width=588px nowrap>
    <select style="width:588px" name="caseno" id="caseno">
      <?php
       while($case_row = mysqli_fetch_array($Case_list))
       {
         $case_name = $case_row['product_name'];
         echo "<option value=$case_name>" . $case_row['product_name'] . "</option>";
       }
       ?>
    </select>
  </td>
</tr>
      <tr>
          <td colspan=10 align=center>
              <INPUT type=submit value="주문">
              &nbsp;&nbsp;
              <INPUT type=reset value="다시 쓰기">
              &nbsp;&nbsp;
              <INPUT type=button value="되돌아가기"
              onclick="history.back(-1)"> <!--버튼이 클릭되었을때 발생하는 이벤트로 자바스크립트를 실행함. 이렇게 하면 바로 이전페이지로 감-->
  				</td>
      </tr>
            <!-- </TABLE> -->
    <!-- </td> -->
    <!-- </tr> -->
    <!-- 입력 부분 끝 -->
    </table>
    </form>
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
