<?php
require_once "../_koneksi.php";
$connection = new Database($host, $user, $pass, $database);
if(@$_GET['page'] == 'rka') {
	include "../controllers/Main.php";
	$main = new Main($connection);
	$id_rka = $connection->conn->real_escape_string($_POST['id_rka']);
	$query = $main->show_rka_join("WHERE tb_rencanakerja.id_rka = '$id_rka'");
	$data = $query->fetch_object();
	$query2 = $main->show_approval($id_rka);
	$data2 = $query2->fetch_array();
	echo json_encode(array('nama_bidang' => $data->nama_bidang, 'nama_kegiatan' => $data->judul_kegiatan, 'anggaran_kegiatan' => $data->b_total, 'anggaran_approval' => $data2['anggaran_approval'], 'anggaran_app' => "Rp. ".number_format($data2['anggaran_approval'], 2, ",", ".")));
}
?>