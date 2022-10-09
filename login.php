<?php
require_once "_koneksi.php";
include "controllers/Login.php";
$log = new Login($connection);
cek_no_session_user();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Login RKAT Fakultas</title>
		<!-- Bootstrap core CSS -->
		<link href="/rkat/assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="/rkat/assets/css/signin.css" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<form class="form-signin" action="login.php" method="POST">
				<h2 class="form-signin-heading" align="center">Login RKAT-FT</h2>
				<?php
				if($_SERVER['REQUEST_METHOD'] == 'POST') {
					echo '<div class="alert alert-danger">';
					$log->login_user();
					echo '</div>';
				} ?>
				<div class="form-group">
					<input type="text" name="user" id="user" class="form-control" placeholder="Username" required autofocus>
				</div>
				<div class="form-group">
					<input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
				</div>
				<div class="form-group">
					<select class="form-control" name="jabatan" id="jabatan" required>
						<option value="">- Pilih Jabatan -</option>
						<option value="Wadek">Wadek</option>
						<option value="Kaprodi">Kaprodi</option>
						<option value="Sekprodi">Sekprodi</option>
						<option value="Lab">Lab</option>
						<option value="KTU">KTU</option>
						<option value="Dekan">Dekan</option>
					</select>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
			</form>
		</div> <!-- /container -->
		<script src="/rkat/assets/js/jquery-3.1.1.min.js"></script>
	<script src="/rkat/assets/js/bootstrap.min.js"></script>
		<script src="/rkat/assets/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>