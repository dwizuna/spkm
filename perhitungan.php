<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $_SESSION['judul']." - ".$_SESSION['welcome']." - oleh ".$_SESSION['by'];?></title>
	
    <!-- Bootstrap core CSS -->
    <link href="ui/css/bootstrap.css" rel="stylesheet">
	<link href="ui/css/cerulean.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="ui/css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--script src="./index_files/ie-emulation-modes-warning.js"></script-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
	<div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $_SESSION['judul'];?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="kriteria.php">Data Kriteria</a></li>
			  <li><a href="subkriteria.php">Data Sub Kriteria</a></li>
              <li><a href="alternatif.php">Data Alternatif</a></li>
			  <li><a href="analisa.php">Analisa</a></li>
              <li class="active"><a href="#">Perhitungan</a></li>
			  <li><a href="profile.php">Profile</a></li>
			  <li><a href="logout.php">Logout</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Perhitungan</li>
		</ol>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Perhitungan</div>
		  <div class="panel-body">
			<div class="text-right"><button class="btn btn-primary btn-sm" onclick="myFunction()">Print</button></div>
			<center>
				<?php
					echo "<b>Matrix Alternatif - Kriteria</b></br>";
					
					$alt = get_alternatif();
					$alt_name = get_alt_name();
					$kep = get_kepentingan();
					$cb = get_costbenefit();
					$kri = get_kriteria();
					$k = jml_kriteria();
					$a = jml_alternatif();
					
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							echo "<td>".$alt[$i][$j]."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Matrix Pembagi</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					echo "<tr><td><b>Pembagi</b></td>";
						for($i=0;$i<$k;$i++){
							$pembagi[$i] = 0;
							for($j=0;$j<$a;$j++){
								$pembagi[$i] = $pembagi[$i] + pow($alt[$j][$i],2);
							}
							$pembagi[$i] = round(sqrt($pembagi[$i]),4);
							echo "<td>".$pembagi[$i]."</td>";
						}
					echo "</tr>";
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Matrix Ternormalisasi</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							$nor[$i][$j] = round(($alt[$i][$j] / $pembagi[$j]),4);
							echo "<td>".$nor[$i][$j]."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Matrix Terbobot</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Alternatif / Kriteria</th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						for($j=0;$j<$k;$j++){
							$bob[$i][$j] = round(($nor[$i][$j] * $kep[$j]),4);
							echo "<td>".$bob[$i][$j]."</td>";
						}
						echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Min Max Berdasarkan Cost Benefit Kriteria</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th>";
						for($i=1;$i<=$k;$i++){
							echo "<th>".ucwords($kri[$i])."</th>";
						}
					echo "</tr></thead>";
					echo "<tr><td><b>A+</b></td>";
						for($i=0;$i<$k;$i++){
							for($j=0;$j<$a;$j++){
								$temp[$j] = $bob[$j][$i];
							}
							if($cb[$i]=='benefit')
								$aplus[$i] = max($temp);
							if($cb[$i]=='cost')
								$aplus[$i] = min($temp);
							echo "<td>".$aplus[$i]."</td>";
						}
					echo "</tr>";
					echo "<tr><td><b>A-</b></td>";
						for($i=0;$i<$k;$i++){
							for($j=0;$j<$a;$j++){
								$temp[$j] = $bob[$j][$i];
							}
							if($cb[$i]=='benefit')
								$amin[$i] = min($temp);
							if($cb[$i]=='cost')
								$amin[$i] = max($temp);
							echo "<td>".$amin[$i]."</td>";
						}
					echo "</tr>";
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Nilai D+ dan D-</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th><th>D+</th><th>D-</th></tr></thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						$dplus[$i] = 0;
						for($j=0;$j<$k;$j++){
							$dplus[$i] = $dplus[$i] + pow(($aplus[$j] - $bob[$i][$j]),2);
						}
						$dplus[$i] = round(sqrt($dplus[$i]),4);
						echo "<td>".$dplus[$i]."</td>";
						$dmin[$i] = 0;
						for($j=0;$j<$k;$j++){
							$dmin[$i] = $dmin[$i] + pow(($amin[$j] - $bob[$i][$j]),2);
						}
						$dmin[$i] = round(sqrt($dmin[$i]),4);
						echo "<td>".$dmin[$i]."</td>";echo "</tr>";
					}
					echo "</table><hr>";
					// ======================================================================== //
					echo "<b>Hasil Akhir</b></br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th></th><th>V</th></tr></thead>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
						$v[$i][0] = round(($dmin[$i] / ($dplus[$i]+$dmin[$i])),4);
						$v[$i][1] = $alt_name[$i];
 						echo "<td>".$v[$i][0]."</td>";
					}
					echo "</table><hr>";
					usort($v, "cmp");
					$i = 0;
					while (list($key, $value) = each($v)) {
						$hsl[$i] = array($value[1],$value[0]); 
						$i++;
					}
					// ======================================================================== //
					echo "<b>Hasil Analisa</b></br>";
					echo "Berikut ini hasil analisa diurutkan berdasarkan hasil nilai tertinggi. </br>Jadi dapat disimpulkan bahwa Alternatif Karyawan terbaik adalah <b>".ucwords(($hsl[0][0]))."</b> dengan nilai <b>".$hsl[0][1]."</b>.";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>No.</th><th>Alternatif</th><th>Hasil Akhir</th></tr></thead>";
					echo "<tbody>";
					for($i=0;$i<$a;$i++){
						echo "<tr><td>".($i+1).".</td><td>".ucwords(($hsl[$i][0]))."</td><td>".$hsl[$i][1]."</td></tr>";
					}
					echo "</tbody></table><hr>";
					
					
										function jml_kriteria(){	
											include 'configdb.php';
											$kriteria = $mysqli->query("select * from kriteria");
											return $kriteria->num_rows;
										}
										
										function jml_alternatif(){	
											include 'configdb.php';
											$alternatif = $mysqli->query("select * from alternatif");
											return $alternatif->num_rows;
										}
										
										function get_kriteria(){
											include 'configdb.php';
											$kriteria = $mysqli->query("select * from kriteria");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=1;
											while ($row = $kriteria->fetch_assoc()) {
												@$kri[$i] = $row["kriteria"];
												$i++;
											}
											return $kri;
										}
										
										function get_kepentingan(){
											include 'configdb.php';
											$kepentingan = $mysqli->query("select * from kriteria");
											if(!$kepentingan){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kepentingan->fetch_assoc()) {
												@$kep[$i] = $row["kepentingan"];
												$i++;
											}
											return $kep;
										}
										
										function get_costbenefit(){
											include 'configdb.php';
											$costbenefit = $mysqli->query("select * from kriteria");
											if(!$costbenefit){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $costbenefit->fetch_assoc()) {
												@$cb[$i] = $row["cost_benefit"];
												$i++;
											}
											return $cb;
										}
										
										function get_alt_name(){
											include 'configdb.php';
											$alternatif = $mysqli->query("select * from alternatif");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i] = $row["alternatif"];
												$i++;
											}
											return $alt;
										}
										
										function get_alternatif(){
											include 'configdb.php';
											$alternatif = $mysqli->query("select * from alternatif");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i][0] = $row["k1"];
												@$alt[$i][1] = $row["k2"];
												@$alt[$i][2] = $row["k3"];
												@$alt[$i][3] = $row["k4"];
												@$alt[$i][4] = $row["k5"];
												$i++;
											}
											return $alt;
										}
										
										function cmp($a, $b){
											if ($a == $b) {
												return 0;
											}
											return ($a > $b) ? -1 : 1;
										}

										function print_ar(array $x){	//just for print array
											echo "<pre>";
											print_r($x);
											echo "</pre></br>";
										}
				?>
			</center>
		  </div>
		  <div class="panel-footer"><?php echo $_SESSION['by'];?><div class="pull-right"></div></div>
		</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="ui/js/jquery-1.10.2.min.js"></script>
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	
	<script>
	function myFunction() {
		window.print();
	}
	</script>
</body></html>