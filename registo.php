<html>
   <meta charset="utf-8">
</html>

<?php

  include_once("db_config.php");
  $title = $_POST['title'];

  // 같은 이름의 카테고리 있는지 검사
  $compareQuery = "SELECT count(product_id) FROM product WHERE product_id='$title' ";
  $compareResult = $mysqli->query($compareQuery);
  $compareData = mysqli_fetch_array($compareResult);
  if ($compareData[0] != 0)  {
    echo "<script>alert('같은 이름의 카테고리가 이미 있습니다.');history.back();</script>";
    exit;
  }

  $query = "INSERT into product (product_id) values ('".$title."')";
  $result = $mysqli->query($query);
if(!$result) // 정상적으로 입력이 되엇는지 확인
{
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('등록 실패');history.back();</script>";

	exit;

} else
{
  $query4 = "SET @COUNT = 0";
  $query5 = "UPDATE product SET position = @COUNT:=@COUNT+1";
  $query6 = "ALTER TABLE product AUTO_INCREMENT=1";
  $result4 = $mysqli->query($query4);
  $result5 = $mysqli->query($query5);
  $result6 = $mysqli->query($query6);

	echo "<script>alert('등록 완료');</script>";

  //echo "<script> opener.parent.location='admin.php';</script>";
  echo "<script> opener.location.reload();</script>";
  echo "<script> 				self.close();				</script>";
	exit;
}
 ?>
