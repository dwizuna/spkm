<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$nik = $_POST['nik']; 
	$alternatif = $_POST['alternatif'];
	$dept = $_POST['dept']; 
	$k1 = $_POST['k1']; 
	$k2 = $_POST['k2'];
	$k3 = $_POST['k3'];
	$k4 = $_POST['k4'];
	$k5 = $_POST['k5'];
	$k6 = $_POST['k6']; 
	$k7 = $_POST['k7'];
	$k8 = $_POST['k8'];
	$k9 = $_POST['k9'];
	$k10 = $_POST['k10'];
	
	$result = $mysqli->query("INSERT INTO `alternatif` (`id_alternatif`, `nik`, `alternatif`, `departemen`, `k1`, `k2`, `k3`, `k4`, `k5`, `k6`, `k7`, `k8`, `k9`, `k10`) 
								VALUES (NULL, '".$nik."', '".$alternatif."', '".$dept."', '".$k1."', '".$k2."', '".$k3."', '".$k4."', '".$k5."', '".$k6."', '".$k7."', '".$k8."', '".$k9."', '".$k10."');");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: alternatif.php');
	}
?>