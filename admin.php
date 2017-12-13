<?php
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

</style>
<script type='text/javascript'>
$(document).ready(function(){
  // Product 메뉴가 아닌 다른 메뉴를 클릭했을 때
  // Product 메뉴가 펼쳐져 있다면 닫고, 해당 메뉴를 하이라이팅한다.
    $('.sideBarLabel >a').click(function(){
      $('.sideBarLabel >a').removeClass("activeFont");
      $(this).addClass("activeFont");
    });

  $('.semiLabelBorder >a').click(function(){
    $('.semiLabelBorder >a').removeClass("activeSemiLabel");
    $(this).addClass("activeSemiLabel");
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

  <!-- 관리자 로그인 안 되어 있을 때 세션 -->
  <?php if (!$_SESSION['is_login']) {
    echo "<script>history.go(-1);</script>";

   } else { ?>
  <?php
  //$_page=$_GET[_page];

  $view_total = 9; //한 페이지에 3개 게시글이 보인다.
  if(!$_page)($_page=1); //페이지 번호가 지정이 안되었을 경우
  $page= ($_page-1)*$view_total;
  //databasecall
  ?>
<!-- Sidebar/menu -->
<?php include("include/sidebar.php"); ?>

<div class="" style="margin-left:250px">

  <div class="w3-panel w3-padding w3-xlarge" style="background-color:#ff8400;color:#ffffff;width:1030px;margin:0px;height:100%">
    <h2 class="w3-padding"><b>NEW</b> Product</h2>
  </div>


<!-- Product grid -->
<div class="w3-container" style="width:1030px; height: 1000px; background-color:#f4f7fa">
    <div class="w3-row-padding w3-grayscale w3-margin-top">

      <?php
      $mainQuery = "SELECT * FROM wow_maintable ORDER BY position asc";
      $mainResult = $mysqli->query($mainQuery);
      $cnt=1;
      while($data = mysqli_fetch_array($mainResult)) {
        $subQuery = "SELECT * FROM wow_subtable WHERE no=$data[product_id]";
        $subResult = $mysqli->query($subQuery);
        $subData = mysqli_fetch_array($subResult);
      ?>

        <div class="w3-col l4 s6 w3-margin" style="width:30%">
            <div class="productName w3-container w3-border" style="height: 200px">
              <p><b><?php echo $subData['product_name']; ?></b>
              (<?php echo $subData['product_subname']; ?>)
              </p>
              <?php if ($data['product_id'] == 0) { ?>
                <a href="#" onclick="window.open('product_maintableplus.php?pos=<?=$data['position']?>','_blank', 'scrollbars=yes width=950 height=600')"> 블록 추가하기 </a>
              <?php } else { ?>
                <a href="#" onclick="window.open('product_maintableplus.php?pos=<?=$data['position']?>','_blank', 'scrollbars=yes width=950 height=600')">블록 수정하기 |&nbsp;</a>
                <a href="product_maintabledelete.php?pos=<?=$data['position']?>"> 블록 삭제하기 </a>
              <?php } ?>
            </div>
            <div class="w3-display-container w3-border">
                    <div class="w3-display-middle w3-xlarge">
                      <h2><?php echo $data['position']."번 칸"; ?></h2>
                    </div>
            </div>
        </div>
        <?php
        	$cnt++;
          }?>
      </div>
</div>

<?php } ?>
<script>
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

// Accordion
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

</script>

</body>
</html>
