<?php  

class DBConnection {
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'phptodo';
	private $conn;

	public function __construct() {
		try {
			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo 'Connection failed' . $e->getMessage();
		}
	}

	public function returnConnection() {
        return $this->conn;  
	}
}

