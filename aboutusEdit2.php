<?php


    include_once("db_config.php");

    $nse_content = $mysqli->escape_string($_POST['ir1']);
    $sql = "update wow_aboutus set content =  '{$nse_content}'";
    $res = $mysqli->query($sql);
      echo "<script>location.replace('aboutus.php')</script>"

?>
