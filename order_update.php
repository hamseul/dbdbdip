<?php
	require_once("db_config.php");

  $sess_id = $_SESSION['session_id'];

  $result = mysqli_query($mysqli, "SELECT * FROM admin WHERE admin_id = '$sess_id'");

  while($row = $result->fetch_assoc()) {
    $u_idx = $row['idx'];
  }

	$cpuno = $_POST['cpuno'];
	$mbno = $_POST['mbno'];
	$ramno = $_POST['ramno'];
	$vgano = $_POST['vgano'];
  $ssdno = $_POST['ssdno'];
  $hddno = $_POST['hddno'];
  $pwrno = $_POST['pwrno'];
  $caseno = $_POST['caseno'];

  $date = date("Y-m-d H:i:s",time());

  $sql = "INSERT INTO orders(user_no, RAM_no, HDD_no, VGA_no, SSD_no,CPU_no, Mainboard_no, POWER_no, Case_no, orddate) VALUES('$u_idx', '$ramno', '$hddno', '$vgano', '$ssdno', '$cpuno', '$mbno', '$pwrno', '$caseno', '$date')";


  $res = $mysqli->query($sql);

  if(!$res){
    die("mysql query error");
    echo "<script>history.go(-1);</script>";
  }
  else {
    echo("succeed");
    echo "<script>location.replace('index.php')</script>";
  }
?>
