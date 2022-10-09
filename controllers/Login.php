<?php
$connection = new Database($host, $user, $pass, $database);

class Login {

	private $mysqli;

	function __construct($connection) {
		$this->mysqli = $connection;
	}

	public function login_adm() {
		$db = $this->mysqli->conn;
		$user = $db->real_escape_string($_POST['user']);
		$pass = $db->real_escape_string($_POST['pass']);
		$pass_hash = hash("sha256", $pass);
		$query = $this->mysqli->fetch("tb_admin", "username_adm = '$user'");
		if($query->num_rows > 0) {
			$data = $query->fetch_object();
			$data_pass = $data->password_adm;
			$data_pass_hash = hash("sha256", $data_pass);
			if($data_pass_hash == $pass_hash) {
				$_SESSION['id_adm'] = $data->id_adm;
				$_SESSION['admin'] = $data->username_adm;
				header("location:/rkat/admin");
			} else {
				echo "Password salah !";
			}
		} else {
			echo "Username salah !";			
		}
	}
	public function logout_adm() {
		unset($_SESSION['id_adm'], $_SESSION['admin']);
		header("location:/rkat/admin/login.php");
	}

	public function login_user() {
		$db = $this->mysqli->conn;
		$user = $db->real_escape_string($_POST['user']);
		$pass = $db->real_escape_string($_POST['pass']);
		$jabatan = $db->real_escape_string($_POST['jabatan']);
		$pass_hash = hash("sha256", $pass);
		$query = $this->mysqli->fetch("tb_unitkerja", "username_uk = '$user'");
		if($query->num_rows > 0) {
			$data = $query->fetch_object();
			$data_pass = $data->password_uk;
			$data_pass_hash = hash("sha256", $data_pass);
			if($data_pass_hash == $pass_hash) {
				$data_jns = $data->jenis_uk;
				if($jabatan == $data_jns) {
					$_SESSION['id_user'] = $data->id_uk;
					$_SESSION['user'] = $data->nama_uk;
					$_SESSION['level'] = $data->jenis_uk;
					header("location:/rkat");
				} else {
					echo "Jabatan tidak cocok dengan username ini";
				}
			} else {
				echo "Password salah !";
			}
		} else {
			echo "Username salah !";			
		}
	}
	public function logout_user() {
		unset($_SESSION['id_user'], $_SESSION['user'], $_SESSION['level']);
		header("location:/rkat/login.php");
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}

}
?>