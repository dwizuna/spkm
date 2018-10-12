<?php
	@session_start();
	$_SESSION['judul'] = 'SPK MUKHTAR';
	$_SESSION['welcome'] = 'SPK Untuk Menentukan Karyawan Terbaik Pada PT. Hexpharm Jaya Menggunakan Metode TOPSIS';
	$_SESSION['by'] = 'Mukhtar Handayani, S.T.';
	$mysqli = new mysqli('localhost','root','1717','spkm');
	if($mysqli->connect_errno){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
?>