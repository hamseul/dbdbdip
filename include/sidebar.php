<nav class="w3-sidebar w3-bar-block w3-top" style="width:250px;background-color:white;overflow:hidden" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <?php if ($_SESSION['is_login']) { ?>
      <center><a href="admin.php"><img src="img/로고.jpg" alt="wow.png" style="width:60%"/></a></center>
      <?php } else { ?>
    <center><a href="index.php"><img src="img/로고.jpg" alt="wow.png" style="width:60%"/></a></center>
    <?php } ?>
  </div>

  <div class="w3-padding-16 w3-large w3-text-black sideBarLabel" style="height:80%;overflow:auto">

    <center><button style="color:black; background-color:white;" onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-large">LOGIN</button></center>

    <a onclick="clickProductMenu()" id="productPage" href="javascript:void(0)" class="w3-button w3-block w3-left-align w3-hover-none w3-padding-16" id="myBtn">
      <b>부품 조회</b>
    </a>
    <?php if ($_SESSION['is_login']) { ?>
    <center><a href="#" class="button special" onclick="window.open('editProduct.php', '_blank', 'scrollbars=yes width=800 height=600')">Product 세부 항목 수정</a></center>
    <? } ?>
    <div id="demoAcc" class="w3-hide w3-animate-top semiLabel">
      <?php
      $query = "SELECT * FROM product";  //desc 내림차순   ASC 오름차순
      $result = $mysqli->query($query);
      $cnt=1;
      while($data = mysqli_fetch_array($result)) {
      ?>
      <?php if ($_SESSION['is_login']) { ?>
        <div class="semiLabelBorder"><a href="productadmin.php?product_type=<?=urlencode("$data[product_id]")?>" class="w3-bar-item w3-button w3-hover-none w3-hover-text-white" style="font-size: 14px; background-color:white"><?php echo "$data[product_id]"?></a></div>
      <?php } else { ?>
        <div class="semiLabelBorder"><a href="product.php?product_type=<?=urlencode("$data[product_id]")?>" class="w3-bar-item w3-button w3-hover-none w3-hover-text-white" style="font-size: 14px; background-color:white"><?php echo "$data[product_id]"?></a></div>
      <?php } ?>      <?php
        $cnt++;
      }?>
    </div>
    <a onclick="clickAnotherMenu()" id="supportPage" href="support.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>주문</b></a>
    <a onclick="clickAnotherMenu()" id="supportPage" href="support.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>A/S</b></a>
    <a onclick="clickAnotherMenu()" id="supportPage" href="support.php" class="w3-bar-item w3-button w3-hover-none w3-hover-text-grey w3-padding-16"><b>게시판</b></a>
  </div>
  <div id='id02' class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; background-color:white;">
        <form class="w3-container" form action="login.php" method="POST">
        <div class="w3-section">
          <label style="color:black;"><b>ID</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter ID" name="inputid" required>
          <label style="color:black;"><b>Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter PW" name="inputpw" required>
          <button class="w3-left w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:white; color:black;" type="submit"><b>Login</b></button>
          <button onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-right w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:white; color:black;"><b>Cancel</b></button>
        </div>

      </form>
      </div>
    </div>
  <div id='id01' class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; background-color:white;">
        <form class="w3-container" form action="changepw.php" method="POST">
          <div class="w3-section">
            <label style="color:white;"><b>CURRENT Password</b></label>
            <input class="w3-input w3-border" type="password" placeholder="Enter current PW" name="inputpw" required>
            <label style="color:white;"><b>NEW Password</b></label>
            <input class="w3-input w3-border" type="password" placeholder="Enter new PW" name="inputcpw" required>
            <button class="w3-left w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:white; color:white;" type="submit"><b>CHANGE</b></button>
            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-right w3-button w3-margin-top w3-margin-bottom" style="width:280px; background-color:white; color:white;"><b>Cancel</b></button>
          </div>

        </form>
      </div>
    </div>

  <?php if ($_SESSION['is_login']) { ?>
    <center><button style="color:white; background-color:white;" class="w3-button w3-large" onclick="location.href='logout.php'" type="button">ADMIN LOGOUT</button></center>
    <center><button style="color:white; background-color:white;" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-large">관리자 비밀번호 변경</button></center>
  <? } ?>
  <div style="text-align: center"><p style="color:black">2017-2 DBDB딥</p></div>
</nav>
