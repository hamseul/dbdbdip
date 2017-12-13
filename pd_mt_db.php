<?php
  include_once("db_config.php");
 session_start();
 include("include/session_timer.php");

  ?>

<html>
   <meta charset="utf-8">
<?php
   $id = AUTO_INCREMENT;
   $title = $_POST['title'];
   $product_name = $_POST['product_name'];
   $product_subname = $_POST['product_subname'];
   $product_picture = $_POST['product_picture'];
   $regdate = date("YmdHis",time());

  $mysqli->query("INSERT INTO wow_subtable VALUES('$id','$title','$product_name', '$product_subname', '$product_picture', '$regdate');") or die(mysql_error());
?>

<input type="button" value="돌아가기" onclick="location='admin.php'">
</html>
