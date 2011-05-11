<?php
	class extend_query {
		protected $parent;
		protected $query = '';
		public function __construct($parent) {
			$this->parent = $parent;
		}

		public function __call($method, $args) {
			if (method_exists($this, $method)) {
				$this->$method($args);
			} else {
				throw new Exception("Bad syntax");
			}
		}

		public function get_query() { return $this->parent->get_query().$this->query; }
	}

	class Query {
		private $query = '';
		public function __construct() {
		}

		public function __call($method, $args) {
			if (method_exists($this, $method)) {
				$this->$method($args);
			}
		}
		public function get_query() { return $this->query; }
		public function select($what) {
			$this->query .= "SELECT ".$what;
			return new select_state($this);
		}
		public function select_all($what) {
			$this->query .= "SELECT ALL ".$what;
			return new select_state($this);
		}
		public function select_distinct($what) {
			$this->query .= "SELECT DISTINCT ".$what;
			return new select_state($this);
		}
	}

	class select_state extends extend_query {
		public function __construct($parent) {
			parent::__construct($parent);
		}

		public function from($table) {
			$this->query .= " FROM '".$table."'";
			return new from_state($this);
		}
	}	

	class from_state extends extend_query {
		public function __construct($parent) {
			parent::__construct($parent);
		}
	
		public function where($wh) {
			$this->query .= " WHERE ".$wh;
			return new extend_query($this); 
		}
	}

	$sql = new Query();

	echo $sql->select("name, pos, id")->from("table_name")->where("id")->get_query();
?>
