<?php

class Db {

	public $conn = NULL;			// Connection object
	private $last_q = NULL;				// Last query return
	
	// DB connection info
	public $hostname = "localhost";
	public $dbname = "epa"; /* name of your database */
	public $login_name = "root"; /* login name to get into database */
	public $password = "SuperHappyMySQL2013"; /* the password to get into your database */
	
	// Connect to master db
	public function connect() {	
		
		$this->conn = new mysqli($this->hostname, $this->login_name, $this->password, $this->dbname);
		
		return $this->conn;
	}
	
	// Query db
	public function query($q) {
	
		if ( !$this->conn ) { $this->connect();	}

		$this->last_q = $this->conn->query($q);
		return $this->last_q;
		
	}
	
	// Alias for above
	public function q($q) {
	
		return $this->query($q);
		
	}
	
	// Query and return one row
	public function one($q) {
		
		$q = $this->query($q);
		if (!$q) { return FALSE; }
		
		return $q->fetch_assoc();
		
	}
	
	// Query and return all rows
	public function all($q) {
	
		$q = $this->query($q);
		if (!$q) { return FALSE; }
		
		$out = null;
		while($r = $q->fetch_assoc()) {
			$out[] = $r;
		}
		
		return $out;
	
	}
	
	// Number of rows
	public function rows() {
	
		return $this->last_q->num_rows;
		
	}
	
	// Escape string
	public function escape($q, $strip_slashes = TRUE) {
	
		if ( !$this->conn ) { $this->connect();	}
		
		if ($strip_slashes == TRUE) { $q = stripslashes($q); }
		
		return $this->conn->real_escape_string($q);
		
	}
}

?>