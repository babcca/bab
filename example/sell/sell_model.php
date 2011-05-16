<?php
require_once(dirname(__file__).'/../../lib/mysql.php');

class sell_model {
	private $db;
	public function __construct() {
		$this->db = new MySql("localhost", "czbabca", "czbabca", "147852369");
	}
	protected function get_sell_list($offset, $count, $user_id = -1) {
		$sql = "SELECT * FROM sell WHERE active = 1";
		if ($user_id != -1) $sql .= "AND user_id = $user_id";
		$sql .= " ORDER BY time DESC";
		return $this->db->query($sql)->fetch_all();
	}

	public function deactive_post_($post_id) {
		$post_id = (int) $post_id;
		$sql = "UPDATE sell SET active = 0 WHERE id = $post_id AND auser_id = ".Enviroment::get_user_id();
		$this->db->query($sql);
		return "1";
	}

	public function post_new_($title, $description, $price, $image) {
		$title = Enviroment::escape($title);
		$description = Enviroment::escape($description);
		$price = Enviroment::escape($price);
		$image = $image;//Uploader($image);
		$sql = "INSERT INTO sell (image, title, description, user_id, time, price, active) VALUES ('$image', '$title', '$description', 'me', ".time().", '$price', 1)";
		$this->db->query($sql);
		return "1";
	}

	public function check_state_($timestamp) {
		$timestamp = (int) $timestamp;
		$ret = array("update" => false);
		$sql = "SELECT id FROM sell WHERE time >= $timestamp";
		$this->db->query($sql);
		
		if ($this->db->row_count() > 0) {
			$ret["update"] = true;
		}
		return json_encode($ret);
	}
}

?>
