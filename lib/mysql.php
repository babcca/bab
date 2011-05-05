<?php

class MySql {
	private $connect = 0;
	private $data = 0;
	private $last_id = 0;
	private $connect_info = array();
	public function __construct($server,$db,$user,$pass) {
		$this->connect_info = array($server, $db, $user, $pass);
		$this->connect = mysql_connect($server, $user, $pass, true);
		if (!$this->connect) {
			die("Pripojeni k db se nezdarilo ".mysql_error());
		}
		mysql_select_db($db);
		$this->query("SET NAMES 'utf8'");
		$this->query("SET CHARACTER SET 'utf8'");
	}

	public function __destruct() {
		//mysql_free_result($this->data);
		mysql_close($this->connect);
	}
	public function row_count() { return mysql_num_rows($this->data); }
	public function last_id() { return $this->last_id; }
	public function query($sql) {
		$this->data = mysql_query($sql, $this->connect);
		if (!$this->data) {
			echo $sql;
			die("Spatny dotaz: ".mysql_error());
		}
		$this->last_id = mysql_insert_id($this->connect);
		return $this;
	}
	public function fetch() {
		if ($this->data)
			return mysql_fetch_array($this->data);
		return false;
	}
	public function fetch_all() {
		$ret = array();
		while ($data = $this->fetch()) $ret[] = $data;
		return $ret;
	}
	
	public function fetch_to_key($key) {
		$ret = array();
		while ($data = $this->fetch()) {
				$ret[$data[$key]][] = $data;
		}
		return $ret;
	}
	public function _clone(&$new_connect) {
		$new_connect = new MySql($this->connect_info[0],$this->connect_info[1],$this->connect_info[2],$this->connect_info[3]);	
	}
}


?>
