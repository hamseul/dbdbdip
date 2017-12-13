<?php
include ('db_config.php');
if(!isset($_SESSION))
{
  session_start();
}

if(!isset($_SESSION['is_login']))
{
  echo "<script>alert('로그인이 필요한 서비스 입니다.');</script>";
  echo "<script>location.href = 'index.php'</script>";
}
?>
