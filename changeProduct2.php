<html>
<meta charset="UTF-8">
</html>


<?php
  include_once("db_config.php");


$primary_key = $_GET['name'];
$newName =  $_POST['title'];

// 같은 이름의 카테고리 있는지 검사
$compareQuery = "SELECT count(product_id) FROM product WHERE product_id='$newName' ";
$compareResult = $mysqli->query($compareQuery);
$compareData = mysqli_fetch_array($compareResult);
if ($compareData[0] != 0)  {
  echo "<script>alert('같은 이름의 카테고리가 이미 있습니다.');history.back();</script>";
  exit;
}

$query = "update product set product_id =  '$newName' where product_id = '$primary_key'";
      $result = $mysqli->query($query);
      $query1 = "UPDATE wow_subtable SET product_title  = '$newName' WHERE product_title = '$primary_key'";
      $result1 = $mysqli->query($query1);

// echo"새로운 이름";
// echo "$newName";
//
// echo "기존 이름";
// echo "$deletprodcut";

if(!$result) // 정상적으로 입력이 되엇는지 확인
{
  header("Content-Type: text/html; charset=UTF-8");
  echo "<script>alert('수정 실패');</script>";
//  $db->DBO();
  exit;

} else
{
  echo "<script>alert('수정 완료');</script>";
  //$db->DBO();
  echo "<script> opener.location.reload();</script>";
  //echo "<script> opener.parent.location='editProduct.php';</script>";
  echo "<script> self.close(); </script>";
  exit;
}
 ?>
