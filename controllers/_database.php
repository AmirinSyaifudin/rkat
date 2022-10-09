<?php
class Database {
	
	private $host; private $user; private $pass; private $database;
	public $conn;

	function __construct($host, $user, $pass, $database) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->database = $database;
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database) or die(mysqli_error());
	}

	public function fetch($table, $where = null) {
		$sql = "SELECT * FROM $table";
		if($where != null) { $sql .= " WHERE $where"; }
		$query = $this->conn->query($sql) or die ($this->conn->error);
		return $query;
	}

	public function fetch_join($sql) {
		$query = $this->conn->query($sql) or die ($this->conn->error);
		return $query;
	}

	public function insert($table, $data = null) {
		$sql = "INSERT INTO $table";
		$field = null;
		$nilai = null;
		foreach ($data as $key => $values) {
			$field .= ",".$key; $nilai .= ",'".$values."'";
		}
		$sql .= "(".substr($field, 1).")";
		$sql .= " VALUES(".substr($nilai, 1).")";
		$query = $this->conn->prepare($sql) or die ($this->conn->error);
		$query->execute();
	}

	public function update($table, $data = null, $where) {
		$sql = "UPDATE $table SET ";
		$set = null;
		foreach ($data as $key => $values) {
			$set .= ", ".$key." = '".$values."'";
		}
		$sql .= substr($set, 1)." WHERE $where";
		$query = $this->conn->prepare($sql) or die ($this->conn->error);
		$query->execute();
	}

	public function delete($table, $where) {
		$sql = "DELETE FROM $table WHERE $where";
		$this->conn->query($sql) or die ($this->conn->error);
	}

}
?>