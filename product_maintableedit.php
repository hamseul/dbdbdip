<?php
  include_once("db_config.php");
  session_start();
  include("include/session_timer.php");
 ?>

<doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<title>상품 정보 수정</title>
<style>
label{
 color:white;
}
</style>
</head>
<body style="background-color:#2c2d32;">
  <?php
  if (!$_SESSION['is_login']) {
    echo "<script>history.go(-1);</script>";

   }
  $editname = $_GET['name'];
$result = $mysqli->query("SELECT *From wow_subtable where product_name = '$editname'");
$data = mysqli_fetch_array($result);
$result1 = $mysqli->query("SELECT *FROM product where not product_id = (SELECT product_title FROM
wow_subtable where product_name='$editname')");
$cnt = 1;
?>


<div class="w3-container">
<form name="join" enctype='multipart/form-data' method="post" action="ed_mt_db.php?name=<?=$data[no]?>">
      <div class="w3-section">
        <label>Product Type</label>
        <select name="product_title" size='1'>
     <option value = '<?=$data[product_title]?>'><?=$data[product_title]?></option>
     <?php while($data1 = mysqli_fetch_array($result1)){?>
       <option value='<?=$data1[product_id]?>'><?=$data1[product_id]?></option>
     <?php $cnt++;}?>

</select>

      </div>

      <div class="w3-section">
        <label>Product Name</label>
        <input class="w3-input" type="text" size="30" name="product_name" value='<?=$data[product_name]?>' required>
      </div>
      <div class="w3-section">
        <label>Product Subname</label>
        <input class="w3-input" type="text" size="30" name="product_subname" value='<?=$data[product_subname]?>'>
      </div>
      <div class="w3-section">
        <label>Product Image</label>
        <input class="w3-input" style="background-color:white;"type="file" size="30" name="product_picture" value='<?=$data[product_picture]?>'>
      </div>

      <button type="submit" class="w3-button w3-border w3-block w3-padding-large w3-margin-bottom" style="background-color:#ff8400; color:white;">Submit</button>
        <button type="button" class="w3-third w3-button w3-border w3-block w3-margin-bottom" style="width:33%; background-color:#ff8400; color:white;" onclick="javascript:document.join.product_title.value='';javascript:document.join.product_name.value='';
 javascript:document.join.product_subname.value='';javascript:document.join.product_picture.value='';">Reset</button>
        <button type="reset" class="w3-third w3-button w3-border w3-block w3-margin-bottom" style="width:33%; background-color:#ff8400; color:white;">Rewrite</button>
        <button type="button" class="w3-third w3-button w3-border w3-block w3-margin-bottom" style="width:33%; background-color:#ff8400; color:white;" onclick="javascript:self.close();">Cancel</button>
    </form>
    </div>

</body>
</html>
