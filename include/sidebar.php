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

  <?php if ($_SESSION['is_login']) { ?>
    <center><button style="color:white; background-color:#2c2d32;" class="w3-button w3-large" onclick="location.href='logout.php'" type="button">ADMIN LOGOUT</button></center>
    <center><button style="color:white; background-color:#2c2d32;" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-large">관리자 비밀번호 변경</button></center>
  <? } ?>
  <div style="text-align: center"><p style="color:#ffffff">ⓒ 2017 WOWSYSTEM Co., Ltd.</p></div>
</nav>
