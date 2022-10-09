<?php
require_once "../_koneksi.php";
include "../controllers/Login.php";
$log = new Login($connection);
cek_no_session_adm();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Admin RKAT Fakultas</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../assets/css/signin.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <form class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">Login Admin RKAT-FT</h2>
		    <?php
	      if($_SERVER['REQUEST_METHOD'] == 'POST') {
	      	echo '<div class="alert alert-danger">';
	      	$log->login_adm();
	      	echo '</div>';
	      } ?>
        <label for="user" class="sr-only">Username</label>
        <input type="text" name="user" id="user" class="form-control" placeholder="Username" required autofocus>
        <label for="pass" class="sr-only">Password</label>
        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
    <script src="../assets/js/jquery-3.1.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>