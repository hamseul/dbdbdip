<?php
  $fileName = $_REQUEST['file_name'];
  $fileName = iconv("UTF-8", "cp949//IGNORE", $fileName);
  $filePath = "./supportUploads/".$fileName;
  Header("Content-Type: file/unknown");
  Header("Content-Disposition: attachment; filename=". $fileName);
  Header("Content-Length: ".filesize("$filePath"));
  Header("Pragma: no-cache");
  Header("Expries: 0");
  flush();

  if ($fp = fopen("$filePath", "r")) {
    print fread($fp, filesize("$filePath"));
  }
  fclose($fp);
 ?>
