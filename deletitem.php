<html>
  <meta charset="UTF-8">
</html>

<?php
  include_once("db_config.php");
 session_start();
 include("include/session_timer.php");
 ?>
<?php

$deletprodcut = $_GET['name'];
$query1 = "DELETE FROM wow_specifictable WHERE s_no IN (SELECT no FROM wow_subtable WHERE product_name = '$deletprodcut')";
$result1 = $mysqli->query($query1);

$mysqli->query("DELETE FROM wow_subtable WHERE product_name = '$deletprodcut'") or die(mysql_error());

  	echo "<script>alert('삭제 완료');</script>";

   echo "<script> history.back();;</script>";


 ?>
