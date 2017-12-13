<?php
$uploads_dir = './img';
$error = $_FILES['product_picture']['error'];
$name = $_FILES['product_picture']['name'];
move_uploaded_file( $_FILES['product_picture']['tmp_name'], "$uploads_dir/$name");
?>

<html>
   <meta charset="utf-8">
</html>
<?php
include_once("db_config.php");
$primary_key = $_GET['name'];
$id = AUTO_INCREMENT;

$title = $_POST['product_title'];
$product_name = $_POST['product_name'];
$product_subname = $_POST['product_subname'];

$regdate = date("YmdHis",time());
$orderNum = '1';
$query = "UPDATE wow_subtable set product_title = '$title', product_name = '$product_name', product_subname = '$product_subname'
,product_picture = '$name',regdate = '$regdate'  where no = '$primary_key'";
$result = $mysqli->query($query);


// 파일 이동
if(!$result) // 정상적으로 입력이 되엇는지 확인
{
	header("Content-Type: text/html; charset=UTF-8");
	echo "<script>alert('등록 실패');history.back();</script>";

	exit;

} else
{
	echo "<script>alert('등록 완료');</script>";

  echo "<script> opener.location.reload();</script>";
  echo "<script> 				self.close();				</script>";
	exit;
}
?>
