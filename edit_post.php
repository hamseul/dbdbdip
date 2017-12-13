<?php
  header("content-type:text/html; charset=UTF-8");
  include_once("db_config.php");
  include("include/session_timer.php");


  $id = $_REQUEST['idx'];  //게시판 ID
  //////회원정보///////
  $query= "SELECT * from wow_specifictable";
  $result= $mysqli->query($query);

  $subject=$_POST[subject]; //게시판 제목
  $story=$_POST[story]; //게시판 내용


 $regdate=date("YmdHis", time());  //날짜 , 시간

//쿼리전송
$query="UPDATE wow_specifictable SET product_s_title = '$subject', product_s_text = '$story' WHERE s_id='$id'";
$mysqli->query($query);

echo "<script>history.go(-2)</script>"
?>
