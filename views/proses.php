<?php
if(@$_GET['page'] == 'add_rka') {
	require_once "../_koneksi.php";
	include "../controllers/Main.php";
	$main = new Main($connection);
	$main->add_rka();
}
?>