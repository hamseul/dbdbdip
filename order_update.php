<?php
	require_once("dbconfig.php");

	//항상 변수 선언
	$cpuno = $_POST['cpuno'];
	$mbno = $_POST['mbno'];
	$ramno = $_POST['ramno'];
	$vgano = $_POST['vgano'];
  $ssdno = $_POST['ssdno'];
  $hddno = $_POST['hddno'];
  $pwrno = $_POST['pwrno'];
  $caseno = $_POST['caseno'];

	if(empty($check))
	{
			if(!empty($_FILES['fileName']['name']))
		{
			$iName = $_FILES['fileName']['name'];
			$iPath = "images/upload/".date('YmdHis').$_FILES['fileName']['name'];
			$iSize = $_FILES['fileName']['size'];
			$tmp_file = $_FILES['fileName']['tmp_name'];
			$tPath = "images/upload/thumbnails/".date('YmdHis').$_FILES['fileName']['name'];
			}
		}

	//글 수정
	if(isset($bno)) {

			$sql = 'update board_db set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = "' . $bno.'"';
			$msgState = '수정';
			$result = $db->query($sql);
				if(!empty($_FILES['fileName']['name']))
				{
					$query = 'select * from board_image where b_no = "'.$bno.'"';
					$count = $db->query($query);
					$num = mysqli_num_rows($count);

					if(empty($check))
					{
							if ($num != 0)
						{
							$sql3 = 'select i_path from board_image where b_no = "' . $bno.'"';
							$r3 = $db->query($sql3);
							$rr = $r3->fetch_assoc();
							unlink($rr['i_path']);
							$sql2 = 'update board_image set i_path="'.$iPath.'", i_name="'.$iName.'", i_size="'.$iSize.'" where b_no = "'.$bno.'"';
							$r = move_uploaded_file($tmp_file, $iPath);
							if(getThumb($iPath, $tPath, 100, 100))
							{
								$sql = 'update board_db set b_src="'.$tPath.'" where b_no = "'.$bno.'"';
								$re = $db->query($sql);
							}
						}
						else {
							$sql2 = 'insert into board_image (i_no, b_no, i_path, i_name, i_size) values (null, "'.$bno.'", "'.$iPath.'", "'.$iName.'", "'.$iSize.'")';
							$r = move_uploaded_file($tmp_file, $iPath);
							if(getThumb($iPath, $tPath, 100, 100))
							{
								$sql = 'update board_db set b_src="'.$tPath.'" where b_no = "'.$bno.'"';
								$re = $db->query($sql);
							}
						}
							$result2= $db->query($sql2);
				}
				else{
					$sql = 'select * from board_image where b_no='.$bno;
					$result4 = $db->query($sql);
					$num = mysqli_num_rows($result4);
					echo "check";
					if($num != 0)
					{
						echo "내가 뭘";
						$bb = $result4->fetch_assoc();
						$path = $bb['i_path'];
						unlink($path);

					$sql = 'delete from board_image where b_no='.$bno;
					$result3 = $db->query($sql);
					}
				}
			}

			if(!empty($check))
			{
				$sql = 'select * from board_image where b_no='.$bno;
				$result4 = $db->query($sql);
				$num = mysqli_num_rows($result4);

				if($num != 0)
				{
					$bb = $result4->fetch_assoc();
					$path = $bb['i_path'];
					unlink($path);
					$sql = 'select* from board_db where b_no='.$bno;
					$re = $db->query($sql);
					$b = $re->fetch_assoc();
					$src = $b['b_src'];
					unlink($src);

				$sql = 'delete from board_image where b_no='.$bno;
				$result3 = $db->query($sql);

					$sql = 'update board_db set b_src= null where b_no = "'.$bno.'"';
					$re = $db->query($sql);
			}
		}
}


		//글 등록.
	 else {

		 	$sql = 'insert into board_db (b_type, b_no, b_title, b_content, b_date, b_hit, b_src) values('. $bType . ', null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, null)';
			$msgState = '등록';
			$result = $db->query($sql);
			if(!empty($_FILES['fileName']['name']))
			{
				$sql = 'select * from board_db size order by b_date DESC limit 1';
				$re = $db->query($sql);
				$num = $re->fetch_assoc();
				$sql2 = 'insert into board_image (i_no, b_no, i_path, i_name, i_size) values (null, "'.$num['b_no'].'", "'.$iPath.'", "'.$iName.'", "'.$iSize.'")';
				$r = move_uploaded_file($tmp_file, $iPath);
				$result2= $db->query($sql2);

				$sql3 = 'UPDATE board_category SET c_num = c_num + 1 WHERE b_type = ' . $bType;
				$r = $db->query($sql3);
				if(getThumb($iPath, $tPath, 100, 100))
				{
					$sql = 'update board_db set b_src="'.$tPath.'" where b_no = "'.$num['b_no'].'"';
					echo $sql;
					$re = $db->query($sql);
					if($re)
					{
						echo "성겅";
					}
					else {
						echo "밍";
					}

				}
			}
		}
<script>
		alert("<?php echo $msg?>");
		location.replace("<?php echo $replaceURL?>");
</script>
