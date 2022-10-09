<?php
$connection = new Database($host, $user, $pass, $database);

class Main {

	public $mysqli; protected $db;

	function __construct($connection) {
		$this->mysqli = $connection;
		$this->db = $connection->conn;
	}

	/* method rencana_kerja start */
	public function show_rka_join($where = null) {
		$sql = "SELECT * FROM tb_rencanakerja INNER JOIN tb_bidanggarapan ON tb_rencanakerja.id_bidang = tb_bidanggarapan.id_bidang INNER JOIN tb_unitkerja ON tb_rencanakerja.unit_kerja = tb_unitkerja.id_uk INNER JOIN tb_kegiatan ON tb_rencanakerja.kode_rka = tb_kegiatan.kode_rka";
		if($where != null) { $sql .= " $where"; }
		$query = $this->mysqli->fetch_join($sql);
		return $query;  
	}
	public function koderka_uk($uk) {
		$sql = "SELECT MAX(kode_rka) FROM (SELECT kode_rka FROM tb_rencanakerja WHERE kode_rka LIKE '%$uk%') rka_uk";
		$query = $this->mysqli->fetch_join($sql);
		return $query;
	} 	
	public function add_rka() {
		$kode_rka = $this->db->real_escape_string($_POST['kode_rka']);
		$id_bidang = $this->db->real_escape_string($_POST['id_bidang']);
		$periode = $this->db->real_escape_string($_POST['periode']);
		$latar_belakang = $this->db->real_escape_string($_POST['latar_belakang']);
		$maksud = $this->db->real_escape_string($_POST['maksud']);
		$tujuan = $this->db->real_escape_string($_POST['tujuan']);
		$judul = $this->db->real_escape_string($_POST['judul']);
		$tgl_awal = $this->db->real_escape_string($_POST['tgl_awal']);
		$tgl_akhir = $this->db->real_escape_string($_POST['tgl_akhir']);
		$tempat = $this->db->real_escape_string($_POST['tempat']);
		$peserta = $this->db->real_escape_string($_POST['peserta']);
		$jumlah_hari = $this->db->real_escape_string($_POST['jumlah_hari']);
		$p_penanggungjawab = $this->db->real_escape_string($_POST['p_penanggungjawab']);
		$p_ketua = $this->db->real_escape_string($_POST['p_ketua']);
		$p_sekretaris = $this->db->real_escape_string($_POST['p_sekretaris']);
		$p_bendahara = $this->db->real_escape_string($_POST['p_bendahara']);
		$p_instruktur = $this->db->real_escape_string($_POST['p_instruktur']);
		$p_asisten = $this->db->real_escape_string($_POST['p_asisten']);
		$b_sktriat = $this->db->real_escape_string($_POST['b_sktriat']);
		$b_konsumsi = $this->db->real_escape_string($_POST['b_konsumsi']);
		$b_honorarium = $this->db->real_escape_string($_POST['b_honorarium']);
		$b_total = $this->db->real_escape_string($_POST['b_total']);

		$cek = $this->show_rka_join("WHERE tb_rencanakerja.kode_rka = '$kode_rka'");
		if($cek->num_rows > 0) {
			echo "<script>alert('Kode RKA sudah ada, silakan ganti yang lain!')</script>";
		} else {
			$data = array('kode_rka' => $kode_rka, 'id_bidang' => $id_bidang, 'periode' => $periode, 'unit_kerja' => $_SESSION['id_user'], 'status_approval' => 'menunggu');
			$this->mysqli->insert("tb_rencanakerja", $data);
			$data2 = array('kode_rka' => $kode_rka, 'latar_belakang' => $latar_belakang, 'maksud' => $maksud, 'tujuan' => $tujuan, 'judul_kegiatan' => $judul, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir, 'tempat' => $tempat, 'peserta' => $peserta, 'jumlah_hari' => $jumlah_hari, 'p_penanggungjawab' => $p_penanggungjawab, 'p_ketua' => $p_ketua, 'p_sekretaris' => $p_sekretaris, 'p_bendahara' => $p_bendahara, 'p_instruktur' => $p_instruktur, 'p_asisten' => $p_asisten, 'b_kesekretariatan' => $b_sktriat, 'b_konsumsi' => $b_konsumsi, 'b_honorarium' => $b_honorarium, 'b_total' => $b_total);
			$this->mysqli->insert("tb_kegiatan", $data2);
		}
	}
	public function del_rka($id) {
		$this->mysqli->delete("tb_rencanakerja", "kode_rka = '$id'");
		$this->mysqli->delete("tb_kegiatan", "kode_rka = '$id'");
		header("location: /rkat?page=rka");
	}
	/* method rencana_kerja end */


	/* method approval start */
	public function show_approval($id) {
		$query = $this->mysqli->fetch("tb_approval JOIN tb_unitkerja ON tb_approval.disetujui_oleh = tb_unitkerja.id_uk", "id_rka = '$id'");
		return $query;
	}
	public function add_approval() {
		$id_rka = $this->db->real_escape_string($_POST['id_rka']);
		$anggaran_approval = $this->db->real_escape_string($_POST['anggaran_approval']);
		$data = array('id_rka' => $id_rka, 'anggaran_approval' => $anggaran_approval, 'disetujui_oleh' => $_SESSION['id_user']);
		$this->mysqli->insert("tb_approval", $data);
		$this->mysqli->update("tb_rencanakerja", array('status_approval' => 'disetujui'), "id_rka = '$id_rka'");
		header("location: /rkat?page=approval");
	}
	public function del_approval($id) {
		$this->mysqli->update("tb_rencanakerja", array('status_approval' => 'menunggu'), "id_rka = '$id'");
		$this->mysqli->delete("tb_approval", "id_rka = '$id'");
		header("location: /rkat?page=approval");
	}
	/* method approval end */


	/* method realisasi start */
	public function show_realisasi($where = null) {
		$sql = "SELECT * FROM tb_realisasi INNER JOIN tb_rencanakerja ON tb_realisasi.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_bidanggarapan ON tb_rencanakerja.id_bidang = tb_bidanggarapan.id_bidang INNER JOIN tb_kegiatan ON tb_rencanakerja.kode_rka = tb_kegiatan.kode_rka INNER JOIN tb_unitkerja ON tb_rencanakerja.unit_kerja = tb_unitkerja.id_uk";
		if($where != null) { $sql .= " $where"; }
		$query = $this->mysqli->fetch_join($sql);
		return $query;  
	}
	public function add_realisasi() {
		$id_rka = $this->db->real_escape_string($_POST['id_rka']);
		$periode = $this->db->real_escape_string($_POST['periode']);
		$tgl_awal = $this->db->real_escape_string($_POST['tgl_awal']);
		$tgl_akhir = $this->db->real_escape_string($_POST['tgl_akhir']);
		$anggaran = $this->db->real_escape_string($_POST['anggaran']);
		$anggaran_approval = $this->db->real_escape_string($_POST['anggaran_approval']);
		$status = $anggaran == $anggaran_approval ? 'sesuai' : 'tidak sesuai';
		$cek = $this->show_realisasi("WHERE tb_realisasi.id_rka = '$id_rka'");
		if($cek->num_rows > 0) {
			echo "<script>alert('Data realisasi dengan kode RKA ini sudah ada!')</script>";
		} else {
			$data = array('id_rka' => $id_rka, 'periode_realisasi' => $periode, 'tgl_awal_r' => $tgl_awal, 'tgl_akhir_r' => $tgl_akhir, 'anggaran_realisasi' => $anggaran, 'status_anggaran' => $status);
			$this->mysqli->insert("tb_realisasi", $data);
			header("location: /rkat?page=realisasi");
		}
	}
	public function del_realisasi($id) {
		$this->mysqli->delete("tb_realisasi", "id_realisasi = '$id'");
		header("location: /rkat?page=realisasi");
	}
	/* method realisasi end */

	function __destruct() {
		$this->db->close();
	}

}
?>