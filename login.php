<?php session_start();
include("include/session_timer.php");
 ?>
<html>
<meta charset="UTF-8">
</html>
<?php

include_once("db_config.php");

$tablename = 'admin';        // 다루는 테이블 호출

$inputid = $_POST['inputid'];
$inputpw = $_POST['inputpw'];

$sql = "SELECT * FROM $tablename WHERE admin_id = '$inputid' AND admin_pw = password('$inputpw')";
$res = $mysqli->query($sql);

$row = $res->fetch_array(MYSQLI_ASSOC);

if($row != null) {
  $_SESSION['session_id'] = $inputid;   // 세션 변수를 아이디 값으로 준 뒤 세션 실행
  $_SESSION['is_login'] = true;
  echo "<script>alert('로그인 성공!')</script>";
  echo "<script>location.replace('admin.php')</script>";
  //header('Location: index.php');
}
else {
  echo "<script>alert('로그인 실패!')</script>";
  echo "<script>history.go(-1);</script>";
  //header('Location: index.php');
}
?>
