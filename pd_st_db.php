<?php
  $uploads_dir = './img';      // 업로드 디렉토리
  $error = $_FILES['product_picture']['error'];
  $file_name = $_FILES['product_picture']['name'];
  move_uploaded_file( $_FILES['product_picture']['tmp_name'], "$uploads_dir/$file_name");
  include_once("db_config.php");
 ?>

<html>
   <meta charset="utf-8">
</html>
<?php


   $id = AUTO_INCREMENT;
   $title = $_POST['product_title'];
   $product_name = $_POST['product_name'];
   $product_subname = $_POST['product_subname'];
   $product_picture = $_POST['product_picture'];
   $regdate = date("YmdHis",time());
   $orderNum = '1';

   $query = "INSERT INTO wow_subtable VALUES('$id','$title','$product_name', '$product_subname', '$file_name', '$regdate', '$orderNum')";
   $result = $mysqli->query($query);
   $query1 = "SET @COUNT = 0";
   $query2 = "UPDATE wow_subtable SET no = @COUNT:=@COUNT+1";
   $query3 = "ALTER TABLE wow_subtable AUTO_INCREMENT=1";
   $result3 = $mysqli->query($query3);
   $result1 = $mysqli->query($query1);
   $result2 = $mysqli->query($query2);
   mysqli_fetch_array($result1);
   mysqli_fetch_array($result2);
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
