<?php
session_start();
ob_start();

/* Setting Koneksi */
$host = "localhost";
$user = "root";
$pass = "";
$database = "db_rkat";


/* Setting Lain2 */
require_once "controllers/_database.php";

/* Function Bebas */
function cek_session_adm() {
	if(@$_SESSION['id_adm'] == null) {
		header("location: /rkat/admin/login.php");
	}
}
function cek_no_session_adm() {
	if(@$_SESSION['id_adm'] != null) {
		header("location: /rkat/admin");
	}
}

function cek_session_user() {
	if(@$_SESSION['id_user'] == null) {
		header("location: /rkat/login.php");
	}
}
function cek_no_session_user() {
	if(@$_SESSION['id_user'] != null) {
		header("location: /rkat");
	}
}

function tgl_indo($tgl) {
	$tanggal = substr($tgl,8,2);
	$bulan = substr($tgl,5,2);
	$tahun = substr($tgl,0,4);
	return $tanggal.'/'.$bulan.'/'.$tahun;		 
}
?>