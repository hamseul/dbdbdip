<?php
  include_once("db_config.php");

  $primary_key = $_GET['idx'];

  $query = "DELETE from wow_specifictable where s_id = '$primary_key'";  //desc 내림차순   ASC 오름차순
  $result = $mysqli->query($query);

  echo "<script>history.go(-1)</script>"
 ?>
