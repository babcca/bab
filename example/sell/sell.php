<?php
require_once(dirname(__file__).'/sell_model.php');

class sell extends sell_model {
	private $render;

	public function __construct() {
		$this->render = new Render('sell');
	}

	public function post_new() {
		Enviroment::set_title("Vytvorit nabidku");
		return $this->render->show("sell_new");
	}
	public function post_list() {
		Enviroment::set_title("Seznam nabidek");
		$rows = array(array("id"=>"1", "img"=>"/img/fhdsajkdf.png", "title"=>"Prodam zenu",
		"description"=>"Prodam krasnou zenu, s plnymi nadry a krasnou prdelkou", "user_id"=>"me", "date"=>date("j.n.Y"), "price"=>"dohodou"));
		$this->render->assign("rows", $rows);
		return $this->render->show("sell_table");
	}

}
?>
