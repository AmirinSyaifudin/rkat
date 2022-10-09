<?php
$connection = new Database($host, $user, $pass, $database);

class Admin {

	private $mysqli;
	private $db;

	function __construct($connection) {
		$this->mysqli = $connection;
		$this->db = $connection->conn;
	}

	/* method unitkerja start */
	public function show_unitkerja($id = null) {
		if($id == null) {
			$query = $this->mysqli->fetch("tb_unitkerja");
		} else {
			$query = $this->mysqli->fetch("tb_unitkerja", "id_uk = '$id'");
		}
		return $query;
	}
	public function add_unitkerja() {
		$nama = $this->db->real_escape_string($_POST['nama']);
		$user = $this->db->real_escape_string($_POST['user']);
		$pass = $this->db->real_escape_string($_POST['pass']);
		$jenis_uk = $this->db->real_escape_string($_POST['jenis_uk']);
		$sql_cek = $this->mysqli->fetch("tb_unitkerja", "username_uk = '$user'");
		if($sql_cek->num_rows > 0) {
			echo "Username ini sudah digunakan akun lain";
		} else {
			$data = array('nama_uk' => $nama, 'username_uk' => $user, 'password_uk' => $pass, 'jenis_uk' => $jenis_uk);
			$this->mysqli->insert("tb_unitkerja", $data);
			header("location: /rkat/admin?page=unitkerja");
		}
	}
	public function edit_unitkerja($id) {
		$nama = $this->db->real_escape_string($_POST['nama']);
		$user = $this->db->real_escape_string($_POST['user']);
		$pass = $this->db->real_escape_string($_POST['pass']);
		$jenis_uk = $this->db->real_escape_string($_POST['jenis_uk']);
		$sql_cek = $this->mysqli->fetch("tb_unitkerja", "username_uk = '$user' AND id_uk != '$id'");
		if($sql_cek->num_rows > 0) {
			echo "Username ini sudah digunakan akun lain";
		} else {
			$data = array('nama_uk' => $nama, 'username_uk' => $user, 'password_uk' => $pass, 'jenis_uk' => $jenis_uk);
			$this->mysqli->update("tb_unitkerja", $data, "id_uk = '$id'");
			header("location: /rkat/admin?page=unitkerja");
		}
	}
	public function del_unitkerja($id) {
		$this->mysqli->delete("tb_unitkerja", "id_uk = '$id'");
		header("location: /rkat/admin?page=unitkerja");
	}
	/* method unitkerja end */


	/* method bidanggarapan */

	public function show_bidanggarapan($id = null) {
		if($id == null) {
			$query = $this->mysqli->fetch("tb_bidanggarapan");
		} else {
			$query = $this->mysqli->fetch("tb_bidanggarapan", "id_bidang = '$id'");
		}
		return $query;
	}
	public function add_bidanggarapan() {
		$nama = $this->db->real_escape_string($_POST['nama']);
		$this->mysqli->insert("tb_bidanggarapan", array('nama_bidang' => $nama));
		header("location: /rkat/admin?page=bidanggarapan");
	}
	public function edit_bidanggarapan($id) {
		$nama = $this->db->real_escape_string($_POST['nama']);
		$this->mysqli->update("tb_bidanggarapan", array('nama_bidang' => $nama), "id_bidang = '$id'");
		header("location: /rkat/admin?page=bidanggarapan");
	}
	public function del_bidanggarapan($id) {
		$this->mysqli->delete("tb_bidanggarapan", "id_bidang = '$id'");
		header("location: /rkat/admin?page=bidanggarapan");
	}

	/* method bidanggarapan end */

	function __destruct() {
		$this->db->close();
	}

}
?>