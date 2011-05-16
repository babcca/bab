<?php
require_once(dirname(__file__).'/sell_model.php');

class sell extends sell_model {
	private $render;
	
	public function __construct() {
		parent::__construct();
		$this->render = new Render('sell');
	}

	public function post_list($offset) {
		Enviroment::set_title("Seznam nabidek");
		$rows = $this->get_sell_list((int) $offset, 10);
		$this->render->assign("rows", $rows);
		return $this->render->show("sell_table");
	}

}
?>
