<?php
require_once "_koneksi.php";
cek_session_user();
include "controllers/Main.php";
$main = new Main($connection);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Sistem Informasi RKAT Fakultas</title>
		<!-- Bootstrap core CSS -->
		<link href="/rkat/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="/rkat/assets/css/custom.css" rel="stylesheet">

		<link href="/rkat/assets/dataTables/dataTables.bootstrap.min.css" rel="stylesheet">
	</head>

	<body>

		<!-- Fixed navbar -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="./">Aplikasi RKAT</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li <?php echo @$_GET['page'] == '' ? 'class="active"' : null; ?>><a href="/rkat">Home</a></li>
						<?php if(@$_SESSION['level'] != "Dekan") { ?>
							<li <?php echo @$_GET['page'] == 'rka' ? 'class="active"' : null; ?>><a href="/rkat?page=rka">Rencana Kerja</a></li>
							<li <?php echo @$_GET['page'] == 'realisasi' ? 'class="active"' : null; ?>><a href="/rkat?page=realisasi">Realisasi</a></li>
						<?php }
						if(@$_SESSION['level'] == "Wadek" || @$_SESSION['level'] == "Kaprodi" || @$_SESSION['level'] == "Dekan") { ?>
							<li <?php echo @$_GET['page'] == 'approval' ? 'class="active"' : null; ?>><a href="/rkat?page=approval">Approval</a></li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="?page=laporan&act=perunit">Laporan Rencana Kerja Per Unit</a></li>
									<li><a href="?page=laporan&act=perperiode">Laporan Rencana Kerja Per Periode</a></li>
									<li><a href="?page=laporan&act=status">Laporan Kegiatan (Usulan/Disetujui)</a></li>
									<li><a href="?page=laporan2&act=budgetvs">Laporan Rencana vs Realisasi</a></li>
								</ul>
							</li>
						<?php } ?>
						<li><a href="?page=laporan2&act=proposal">Cetak Proposal Kegiatan</a></li>
					</ul>
					<a href="?page=logout" class="btn btn-danger navbar-btn navbar-right"><i class="glyphicon glyphicon-off"></i> Logout</a>
					<ul class="nav navbar-nav navbar-right hidden-xs">
						<li><a>Selamat datang, <?php echo ucwords(@$_SESSION['user']); ?></a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
		
		<script src="/rkat/assets/js/jquery-3.1.1.min.js"></script>

		<div class="container" id="cont">
			<?php if(@$_GET['page'] == '') { ?>
				<div class="jumbotron">
					<h2>Sistem Informasi RKAT Fakultas</h2>
					<p>Selamat datang di halaman utama</p>
				</div>
			<?php
			} else if(@$_GET['page'] == 'rka') {
				include "views/rencanakerja.php";
			} else if(@$_GET['page'] == 'realisasi') {
				include "views/realisasi.php";
			} else if(@$_GET['page'] == 'approval') {
				include "views/approval.php";
			} else if(@$_GET['page'] == 'laporan') {
				include "views/laporan.php";
			} else if(@$_GET['page'] == 'laporan2') {
				include "views/laporan2.php";
			} else if(@$_GET['page'] == 'logout') {
				include "controllers/Login.php";
				$log = new Login($connection);
				$log->logout_user();
			} ?>

			<footer class="footer" id="footer">
					<p class="text-muted">&copy; Copyright 2017 - YukCoding.</p>
			</footer>
		</div> <!-- /container -->


		<!-- JavaScript -->
		<script src="/rkat/assets/js/bootstrap.min.js"></script>

		<script src="/rkat/assets/dataTables/jquery.dataTables.min.js"></script>
		<script src="/rkat/assets/dataTables/dataTables.bootstrap.min.js"></script>
	</body>
</html>