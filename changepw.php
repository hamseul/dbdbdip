<?php session_start();
include("include/session_timer.php");
 ?>
<html>
<meta charset="UTF-8">
</html>
<?php

include_once("db_config.php");

$tablename = 'admin';        // 다루는 테이블 호출

$inputcurpw = $_POST['$inputcurpw'];
$inputnewpw = $_POST['$inputnewpw'];

$sql = "SELECT * FROM $tablename WHERE admin_pw = '$inputcurpw'";
$res = mysqli_query($mysqli, $sql);

if($res) {
  $changeQuery = "UPDATE $tablename SET admin_pw = password('$inputnewpw') WHERE admin_pw = '$inputcurpw'";
  $changeResult = mysqli_query($mysqli, $changeQuery);
  if($changeResult){
    echo "<script>alert('비밀번호 변경 성공!')</script>";
    echo "<script>location.replace('admin.php')</script>";
  }
  //header('Location: index.php');
}
else {
  die("실패");
  echo "<script>alert('비밀번호 변경 실패!')</script>";
  echo "<script>history.go(-1);</script>";
  //header('Location: index.php');
}
?>
