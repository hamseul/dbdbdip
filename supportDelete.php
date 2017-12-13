<html>
<meta charset="UTF-8">
</html>

<?php
  include_once("db_config.php");
  $num = $_GET['name'];
  $query = "delete from wow_support where no = $num";  //desc 내림차순   ASC 오름차순
  $result = $mysqli->query($query);

if(!$result) // 정상적으로 입력이 되엇는지 확인
{
  header("Content-Type: text/html; charset=UTF-8");
  echo "<script>alert('삭제 실패');</script>";
} else
{
  // $query1 = "SET @COUNT = 0";
  // $query2 = "UPDATE wow_support SET no = @COUNT:=@COUNT+1";
  // $result = $mysqli->query($query1);
  // $result = $mysqli->query($query2);

  echo "<script>alert('삭제 완료');</script>";
  echo "<script>location.href='support.php';</script>";
  exit;
 }


 ?>
