<html>
<meta charset="UTF-8">
</html>

<?php
  include_once("db_config.php");

$primary_key = $_GET['name'];
//echo "$primary_key";

$query = "DELETE from product where product_id = '$primary_key'";  //desc 내림차순   ASC 오름차순
$result = $mysqli->query($query);
$query1 = "DELETE FROM wow_specifictable WHERE s_no IN (SELECT no FROM wow_subtable WHERE product_title = '$primary_key')";
$result1 = $mysqli->query($query1);
$query2 = "DELETE FROM wow_subtable WHERE product_title = '$primary_key'";
$result2 = $mysqli->query($query2);

if(!$result) // 정상적으로 입력이 되엇는지 확인
{
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('삭제 실패');</script>";

	exit;

} else
{
  $query4 = "SET @COUNT = 0";
  $query5 = "UPDATE product SET position = @COUNT:=@COUNT+1";
  $query6 = "ALTER TABLE product AUTO_INCREMENT=1";
  $result4 = $mysqli->query($query4);
  $result5 = $mysqli->query($query5);
  $result6 = $mysqli->query($query6);



	echo "<script>alert('삭제 완료');</script>";

  echo "<script> opener.location.reload();</script>";
  //echo "<script> opener.parent.location='admin.php';</script>";
  echo "<script> 				self.close();				</script>";
	exit;
 }
 ?>
