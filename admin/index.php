<?php
require_once "../_koneksi.php";
cek_session_adm();
include "../controllers/Admin.php";
$adm = new Admin($connection);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Admin RKAT Fakultas</title>
		<!-- CSS -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="../assets/css/custom.css" rel="stylesheet">

		<link href="../assets/dataTables/dataTables.bootstrap.min.css" rel="stylesheet">  </head>

	<body>

		<!-- Fixed navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="./">Admin RKAT</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li <?php echo @$_GET['page'] == '' ? 'class="active"' : null; ?>><a href="/rkat/admin">Home</a></li>
						<li <?php echo @$_GET['page'] == 'unitkerja' ? 'class="active"' : null; ?>><a href="/rkat/admin?page=unitkerja">Unit Kerja</a>
						<li <?php echo @$_GET['page'] == 'bidanggarapan' ? 'class="active"' : null; ?>><a href="/rkat/admin?page=bidanggarapan">Bidang Garapan</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="?page=logout" style="background-color: #d9534f; color: #fff"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<script src="../assets/js/jquery-1.12.4.js"></script>

		<div class="container" id="cont">
			<?php if(@$_GET['page'] == '') { ?>
				<div class="jumbotron">
					<h2>Admin Panel</h2>
					<p>Selamat datang di halaman administrator</p>
				</div>
			<?php
			} else if(@$_GET['page'] == 'unitkerja') {
				include "views/unitkerja.php";
			} else if(@$_GET['page'] == 'bidanggarapan') {
				include "views/bidanggarapan.php";
			} else if(@$_GET['page'] == 'logout') {
				include "../controllers/Login.php";
				$log = new Login($connection);
				$log->logout_adm();
			} ?>

			<footer class="footer" id="footer">
					<p class="text-muted">&copy; Copyright 2017 - YukCoding.</p>
			</footer>
		</div> <!-- /container -->


		<!-- JavaScript -->
		<script src="../assets/js/bootstrap.min.js"></script>

		<script src="../assets/dataTables/jquery.dataTables.min.js"></script>
		<script src="../assets/dataTables/dataTables.bootstrap.min.js"></script>
	</body>
</html>