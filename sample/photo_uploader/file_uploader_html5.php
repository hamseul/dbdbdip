<?php
 	$sFileInfo = '';
	$headers = array();

	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		}
	}

  $file = new stdClass;
  $file->size = $headers['file_size'];
  
  $test = explode(".", rawurldecode($headers['file_name']));
  $name = str_replace("\0", "", time().'-'.rand(0,100).'-'.$file->size.'.'.$test[1]);

	$file->name = str_replace("\0", "", rawurldecode($name)); // 여기서 변경
	$file->content = file_get_contents("php://input");

	$filename_ext = strtolower(array_pop(explode('.',$file->name)));
	$allow_file = array("jpg", "png", "bmp", "gif");

	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$file->name;
	} else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}

		$newPath = $uploadDir.iconv("utf-8", "cp949", $file->name);

		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$file->name;
			$sFileInfo .= "&sFileURL=upload/".$file->name;
		}

		echo $sFileInfo;
	}
?>
