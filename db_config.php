<?php
$host = 'localhost';            // 호스트 이름을 설정
$user = 'root';                 // 최고 권한 관리자 root
$pw = 'autoset';               // root 관리자 비밀번호
$dbname = 'database';           // 메인 데이터베이스 호출

$mysqli = new mysqli($host, $user, $pw, $dbname);

if($mysqli->connect_error) {
		die('DB connection error');
	}

$mysqli->query('set names utf8');

?>
