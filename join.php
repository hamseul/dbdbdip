<?php session_start();
include("include/session_timer.php");
 ?>
<html>
<meta charset="UTF-8">
</html>
<?php

include_once("db_config.php");

$tablename = 'admin';        // 다루는 테이블 호출

$inputid = $_POST['joinId'];
$inputpw = $_POST['joinPw'];
$inputna=$_POST['joinName'];
$inputpn=$_POST['joinNumber'];
$inputad=$_POST['joinAdd'];

$sql = "INSERT INTO $tablename(admin_id, admin_pw, type, name, phone_number, address) VALUES ('$inputid', '$inputpw', 1, '$inputna', '$inputpn', '$inputad')";
$result = mysqli_query($mysqli, $sql);

if($result) {
  echo "<script>alert('회원가입 성공!')</script>";
  echo "<script>location.replace('index.php')</script>";
  //header('Location: index.php');
}
else {
  die("실패");
  //header('Location: index.php');
}
?>
