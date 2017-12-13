<?php
  session_start();
  include_once("db_config.php");
  include("include/session_timer.php");
  echo "<script> opener.location.reload();</script>";
 ?>


<!DOCTYPE HTML>
<html>
	<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="UTF-8">

		<!--위 아래 움직이는 테이블 ==== 스타일-->
		<style>
		.table1 {
		border:6px solid silver;
		border-radius:5px;
	}
	.table1 td {
		border-bottom:1px solid gray;
		padding:7px;
	}
	.table1 tr:last-child td { /* 마지막 td 는 border-bottom 없애기 */
		border-bottom:0;
	}

		</style>
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



  </head>
  <body>

  <?php  if($_SESSION['is_login']) { ?>



    <?php
    //디비 로드
		$query = "SELECT * FROM product  ORDER BY position ASC";
		$result = $mysqli->query($query);
		$n = 1;

    $deletprodcut ; // 삭제할 프로덕트 아이디
		?>



      <table  id = "table_1" align="center" cellspacing="3" class="w3-table w3-bordered" style="margin-top: 16px; border-top-style: solid; border-top-color: #ff8400; border-bottom-style: solid; border-bottom-color: #ff8400;">
        <?php  while($data = mysqli_fetch_array($result)){ ?>
       <tr id = "<?php echo $n ?>">
         <td style="width: 200px; text-align: center">
         <?php echo   $data['product_id'] ;?>
       </td>
          <td style="width: 150px; text-align: center">
      <button onclick="window.open('changeProduct.php?name=<?=urlencode("$data[product_id]")?> ', '_blank', 'scrollbars=yes width=500 height=200')">수정</button>
       <button onclick="location.href='deleteProduct.php?name=<?=urlencode("$data[product_id]")?> '"> 삭제</button>
          </td>

          <td style="width: 200px; text-align: center">
             <button type="button" onclick="location.href='editProduct2.php?name=<?=$n?>&p=0'">위로 이동</button>
             <button type="button" onclick="location.href='editProduct2.php?name=<?=$n?>&p=1'">아래로 이동</button>
          </td>
     </tr>
      <?php
        $title[$n] =  $row['product_id'];
        $n++;
      }
      ?>
    </table>



    <form action='./registo.php' method='post'>
      <table style='margin:0 auto; margin-top:5%;'>
    <th >추가하기</th>
    <tr>
    <td><input type='text' name='title'size='30' placeholder='product 입력'/></td>
    </tr>
    <tr>
    <td style='text-align:right;'><input type='submit' value='등록'/></td>
  	</tr>




    <?php } ?>
</body>
</html>
