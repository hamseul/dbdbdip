<?php
$uploads_dir = './supportUploads';      // 업로드 디렉토리
$error = $_FILES['support_file']['error'];
$file_name = $_FILES['support_file']['name'];
$encName = iconv("UTF-8", "cp949//IGNORE", $file_name);
move_uploaded_file( $_FILES['support_file']['tmp_name'], "$uploads_dir/$encName");

  $cnt = $_GET['cnt'];
  $cnt = $cnt+2;

    include_once("db_config.php");
    $date = date("Y-m-d H:i:s",time());
    $primary_key = $_REQUEST['name'];
    $posttitle = $_POST['title'];
    $nse_content = $mysqli->escape_string($_POST['ir1']);
    $sql = "update wow_support set content =  '{$nse_content}', title = '$posttitle', regdate ='$date', file = '$file_name'  where no = '$primary_key'";
    $res = $mysqli->query($sql);
      echo "<script>location.replace('supportboard.php?name=$primary_key&cnt=$cnt')</script>"
    /*
    if($res){
        //입력 성공시
        {
          echo "<script>alert('수정 완료');</script>";
          echo "<script>history.go(-2);   </script>";

    } else{
      header("Content-Type: text/html; charset=UTF-8");
      echo "<script>alert('수정 실패');</script>";
   }
   */
?>
