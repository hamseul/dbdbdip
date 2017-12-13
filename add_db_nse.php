<?php
    $uploads_dir = './supportUploads';      // 업로드 디렉토리
    $error = $_FILES['support_file']['error'];
    $file_name = $_FILES['support_file']['name'];
    $encName = iconv("UTF-8", "cp949//IGNORE", $file_name);
    move_uploaded_file( $_FILES['support_file']['tmp_name'], "$uploads_dir/$encName");

    include_once ("db_config.php"); // 데이터 베이스 접속 프로그램 불러오기

    // $query2 = "SELECT * FROM wow_support  order by no desc";
    // $result2 = $mysqli->query($query2);
    // $data2 = mysqli_fetch_array($result2);
    // $noNumber = $data2['no'] +1;

    // $query1 = "SET @COUNT = 0";
    // $query2 = "UPDATE wow_support SET no = @COUNT:=@COUNT+1";
    // $result = $mysqli->query($query1);
    // $result = $mysqli->query($query2);


    $date = date("Y-m-d H:i:s",time());
    $posttitle = $_POST[title];

    $nse_content = $mysqli->escape_string($_POST['ir1']);
    //$sql = "insert into nse_tb(content, title)";
    //$sql .= " values ('{$nse_content}', '$posttitle')";
    $sql = "insert into wow_support(content, title, regdate, file ) values ('{$nse_content}','$posttitle', '$date', '$file_name')";
    $res = $mysqli->query($sql);
    if($res){
        //입력 성공시
       echo "<script>location.replace('support.php')</script>";

    } else{
        echo "fail"; // 디비 입력 실패시 fail표시
    }
?>
