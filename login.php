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
$typesql="SELECT type FROM $tablename WHERE admin_id = '$inputid' AND admin_pw = password('$inputpw')";
$typeres = $mysqli->query($typesql);


$typetemp = mysqli_fetch_array($typeres);
$loginType = $typetemp[0];

$row = $res->fetch_array(MYSQLI_ASSOC);

if($row != null && $loginType==0) {
  $_SESSION['session_id'] = $inputid;   // 세션 변수를 아이디 값으로 준 뒤 세션 실행
  $_SESSION['is_login'] = true;
  $_SESSION['type']=$loginType;
  echo "<script>alert('로그인 성공!')</script>";
  echo "<script>location.replace('admin.php')</script>";
  //header('Location: index.php');
}
else if($row != null && $loginType==1){
  $_SESSION['session_id'] = $inputid;   // 세션 변수를 아이디 값으로 준 뒤 세션 실행
  $_SESSION['is_login'] = true;
  $_SESSION['type']=$loginType;
  echo "<script>alert('로그인 성공!')</script>";
  echo "<script>location.replace('index.php')</script>";
}
else {
  echo "<script>alert('로그인 실패!')</script>";
  echo "<script>history.go(-1);</script>";
  //header('Location: index.php');
}
?>
