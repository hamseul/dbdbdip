<?php session_start();
include("include/session_timer.php");
 ?>

 <!DOCTYPE HTML>
 <html>
 <meta charset="UTF-8">
 	<head>
   </head>
   <body>
     <?php
     $primary_key = $_GET['name'];
      ?>

 <form action='changeProduct2.php?name=<?=urlencode("$primary_key") ?>' method='post'>
   <table style='margin:0 auto; margin-top:5%;'>
<th >수정하기</th>
<tr>
<td>기존 이름 : <?php echo "$primary_key";?> </td>
</tr>
<tr>
<td><input type='text' name='title'size='30' placeholder='<?php echo "$primary_key"; ?>'/></td>
</tr>
<tr>
     <td style='text-align:right;'><input type='submit' value='등록'/></td>
</tr>
</body>
</html>
