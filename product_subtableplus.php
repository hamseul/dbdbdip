<?php
  include_once("db_config.php");
  session_start();
  include("include/session_timer.php");
 ?>
<doctype html>
<html style="height:600px;">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<title>상품 정보 입력</title>
<style>
label{
 color:white;
}
</style>
</head>
<body style="background-color:#2c2d32; resize: none;">

  <?php
  if (!$_SESSION['is_login']) {
    echo "<script>history.go(-1);</script>";

   }
  $productCategory = $_REQUEST['product_title_admin'];
  $result1 = $mysqli->query("SELECT *FROM product where not product_id = '$productCategory'");
  $cnt = 1;?>
  <div class="w3-container">
<form name="join" enctype='multipart/form-data' method="post" action="pd_st_db.php">
      <div class="w3-section">
        <label>Product Type</label>
        <select name="product_title" size='1'>
       <option value = '<?=$productCategory?>'><?=$productCategory?></option>
       <?php while($data1 = mysqli_fetch_array($result1)){?>
         <option value='<?=$data1[product_id]?>'><?=$data1[product_id]?></option>
       <?php $cnt++;}?>

  </select>

      </div>

      <div class="w3-section">
        <label>Product Name</label>
        <input class="w3-input" type="text" size="30" name="product_name" required>
      </div>
      <div class="w3-section">
        <label>Product Subname</label>
        <input class="w3-input" type="text" size="30" name="product_subname">
      </div>
      <div class="w3-section">
        <label>Product Image</label>
        <input class="w3-input" style="background-color:white;"type="file" size="30" name="product_picture">
      </div>

      <button type="submit" class="w3-center w3-button w3-border w3-block w3-padding-large w3-margin-bottom" style="background-color:#ff8400; color:white;">Submit</button>

      <button type="reset" class="w3-left w3-button w3-border w3-block w3-margin-bottom" style="width:250px; background-color:#ff8400; color:white;">Reset</button>
      <button type="button" class="w3- right w3-button w3-border w3-block w3-margin-bottom" style="width:250px; background-color:#ff8400; color:white;" onclick="javascript:self.close();">Cancel</button>

    </form>
    </div>
</body>
</html>
