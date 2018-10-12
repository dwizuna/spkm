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
    <!--link href="ui/css/bootstrap.css" rel="stylesheet"-->
	<link href="ui/css/cerulean.min.css" rel="stylesheet">

    <!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="ui/css/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" type="text/css" href="ui/css/buttons.bootstrap.min.css">
	
	<script type="text/javascript" language="javascript" src="ui/js/jquery-1.11.3.min.js"></script>
	
	<!-- DataTables -->
	<script src="ui/js/jquery.dataTables.min.js"></script>
	<script src="ui/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/buttons.print.min.js"></script>
	<script type="text/javascript" language="javascript" src="ui/js/buttons.colVis.min.js"></script>

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
	<div id="wrapper">
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
			  <li class="active"><a href="subkriteria.php">Data Sub Kriteria</a></li>
              <li><a href="alternatif.php">Data Alternatif</a></li>
			  <li><a href="analisa.php">Analisa</a></li>
              <li><a href="perhitungan.php">Perhitungan</a></li>
			  <li><a href="profile.php">Profile</a></li>
			  <li><a href="logout.php">Logout</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Data Sub Kriteria</li>
		</ol>
	  <div id="page-wrapper">
      <div class="row">
      <div class="col-lg-12">
	  <div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Data Sub Kriteria</div>
		    <?php
							$kriteria = $mysqli->query("select sk.id_sub_kriteria, k.kriteria, sk.sub_kriteria, sk.skor from sub_kriteria sk, kriteria k where sk.id_kriteria = k.id_kriteria order by sk.id_kriteria, sk.skor");
							if(!$kriteria){
								echo $mysqli->connect_errno." - ".$mysqli->connect_error;
								exit();
							}
							$i=0;
		    ?>
		  <div class="panel-body table-responsive">
			<a class='btn btn-primary' href='add-subkriteria.php'> Tambah Data Sub Kriteria</a><br /><br />
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kriteria</th>
					<th>Sub Kriteria</th>
					<th>Skor</th>
					<th>Opsi</th>
				</tr>
			</thead>
		 
			<tfoot>
				<tr>
					<th>No.</th>
					<th>Kriteria</th>
					<th>Sub Kriteria</th>
					<th>Skor</th>
					<th>Opsi</th>
				</tr>
			</tfoot>
		 
			<tbody>
										<?php
												$i = 1;
												while ($row = $kriteria->fetch_assoc()) {
													echo '<tr>';
													echo '<td>'.$i++.'</td>';
													echo '<td>'.ucwords($row["kriteria"]).'</td>';
													echo '<td>'.$row["sub_kriteria"].'</td>';
													echo '<td class="text-uppercase">'.$row["skor"].'</td>';
													echo '<td><!--a href="#"><i class="fa fa-search"></i></a-->';
										?>
														  <a href="edit-subkriteria.php?id=<?php echo $row["id_sub_kriteria"];?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
														   <a href="del-subkriteria.php?id=<?php echo $row['id_sub_kriteria'];?>" onClick="return confirm('Menghapus data Sub Kriteria ke-<?php echo $i-1;?> <?php echo ucwords($row['kriteria']).' adalah '.ucwords($row['sub_kriteria']);?> ?');" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</a>
														  <!--a href="#"><i class="fa fa-times"></i></a></td-->
										<?php
													echo '</tr>';
												}
										?>
			</tbody>
			</table>
		  </div>
		  <div>
		  </div>
		  <div class="panel-footer"><?php echo $_SESSION['by'];?><div class="pull-right"></div></div>
		</div>
		</div>
	</div>
	</div>
	</div> <!-- /page wrapper -->
    </div> <!-- /container -->
	</div> <!-- /wrapper -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
	
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	
	<!-- page script -->
	<script>
	$(document).ready(function() {
		$('#example').DataTable( {
			"ordering": false,
			"language": {
					"url": "ui/css/datatables/Indonesian.json"
				},
			dom: 'Bfrtip',
			buttons: [
				'copy', 'excel', 'pdf', 'print'
			]
		} );
	} );
	</script>
</body></html>