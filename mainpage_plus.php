<doctype html>
  <?php
include_once("db_config.php");
  session_start();
  include("include/session_timer.php");
  ?>

<html>
<head>
<meta charset="utf-8">
<title>Newproductplus</title>
</head>
<body>
  <?php
  $no = $_REQUEST['no'];
  $getpos = $_REQUEST['pos'];

  $query = "UPDATE wow_maintable SET product_id = '$no' WHERE position = '$getpos'";
  $result = $mysqli->query($query);
  if(!$result) // 정상적으로 입력이 되엇는지 확인
  {
   header("Content-Type: text/html; charset=UTF-8");
   echo "<script>alert('등록 실패');history.back();</script>";

   exit;

  } else
  {
   echo "<script>alert('등록 완료');</script>";

    echo "<script> opener.parent.location='admin.php';</script>";
    echo "<script> 				self.close();				</script>";
   exit;
  }
?>

</body>
</html>
