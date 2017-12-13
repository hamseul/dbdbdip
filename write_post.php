<?php
  header("content-type:text/html; charset=UTF-8");
  include_once("db_config.php");
  include("include/session_timer.php");


  $id= $_REQUEST['idx'];  //게시판 ID
  //////회원정보///////
  $query= "SELECT * from wow_specifictable";
  $result= $mysqli->query($query);

 $subject=$_POST[subject]; //게시판 제목
 $story=$_POST[story]; //게시판 내용

 $regdate=date("YmdHis", time());  //날짜 , 시간

//쿼리전송
$query="INSERT into wow_specifictable(s_no,product_s_title, product_s_text, product_location, regdate)
                   values('$id','$subject','$story','','$regdate')";
$mysqli->query($query);
$query1 = "SET @COUNT = 0";
$query2 = "UPDATE wow_specifictable SET s_id = @COUNT:=@COUNT+1";
$query3 = "ALTER TABLE wow_specifictable AUTO_INCREMENT=1";
$result3 = $mysqli->query($query3);
$result1 = $mysqli->query($query1);
$result2 = $mysqli->query($query2);
mysqli_fetch_array($result1);
mysqli_fetch_array($result2);
echo "<script>history.go(-2)</script>"
?>
