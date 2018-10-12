<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$kriteria = $_POST['kriteria'];
	$subkriteria = $_POST['subkriteria']; 
	$skor = $_POST['skor'];
	
	$result = $mysqli->query("INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `skor`) 
								VALUES (NULL, '".$kriteria."', '".$subkriteria."', '".$skor."');");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: subkriteria.php');
	}
?>