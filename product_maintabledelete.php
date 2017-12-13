<?php
include_once("db_config.php");
session_start();
include("include/session_timer.php");
?>

<doctype html>

<html>
<head>
<meta charset="utf-8">
<title>maintabledelete</title>
</head>
<body>
  <?php
  $getpos = $_REQUEST['pos'];
  $query = "UPDATE wow_maintable SET product_id = 'NULL' WHERE position = '$getpos'";
  $result = $mysqli->query($query);
  $data = mysqli_fetch_array($result);
  echo "<script>history.back()</script>"
?>

</body>
</html>
