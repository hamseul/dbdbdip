<doctype html>
  <?php
include_once("db_config.php");
  session_start();
  include("include/session_timer.php");
  ?>
<html>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
table, tr, td{margin:0px;}

#page_1{font-family:굴림,돋음,sans-serif; font-size:10px; font-weight:normal; color:#676460; text-align:center;
line-height:20px;
margin:30px;
}
#font1{font-family:굴림,돋음,sans-serif; font-size:15px; font-weight:bold; color:#676460; text-align:center;  float:left;
}
</style>
<head>
<meta charset="utf-8">
<title>ADD NEW PRODUCT</title>
</head>
<body>
  <table class="w3-table w3-bordered w3-di" style="width:850px; margin-top: 16px; border-top-style: solid; border-top-color: #ff8400; border-bottom-style: solid; border-bottom-color: #ff8400; margin-left:32px; margin-right:32px;">
    <tr>
      <th style="width: 200px; text-align: center">Category</th>
      <th style="width: 250px; text-align: center">Product</th>
      <th style="width: 90px; text-align: center">SELECT</th>
    </tr>
  <?php
  if (!$_SESSION['is_login']) {
    echo "<script>history.go(-1);</script>";

   }
  $getpos = $_REQUEST['pos'];
  $query = "SELECT * FROM wow_subtable WHERE no NOT IN (SELECT product_id FROM wow_maintable) order by product_title asc";
  $result = $mysqli->query($query);

  $cnt=1;
  while($data = mysqli_fetch_array($result)) {
  ?>
      <tr>
        <td style="text-align: center; font-size:15px;"><?php echo $data['product_title']?></td>
        <td style="text-align: center; font-size:15px;"><?php echo $data['product_name']?></td>
<td style="text-align: center; font-size:15px;"><button type="button" onclick="location.href='mainpage_plus.php?no=<?=$data[no]?>&pos=<?=$getpos?>'">추가</button></td></tr>
      <?php
    $cnt++;}
?>
</table>
</body>
</html>
