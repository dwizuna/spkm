<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$kriteria = $_POST['kriteria']; 
	$subkriteria = $_POST['subkriteria'];
	$skor = $_POST['skor'];
	
	$result = $mysqli->query("UPDATE sub_kriteria SET `id_kriteria` = '".$kriteria."', `sub_kriteria` = '".$subkriteria."', `skor` = '".$skor."' WHERE `id_sub_kriteria` = ".$_GET['id'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: subkriteria.php');
	}
?>