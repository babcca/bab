<?php
require_once(dirname(__file__).'/sell_model.php');

class sell extends sell_model {
	private $render;
	
	public function __construct() {
		parent::__construct();
		$this->render = new Render('sell');
	}

	public function post_list($offset, $count) {
		Enviroment::set_title("Seznam nabidek");
		$rows = $this->get_sell_list((int) $offset, (int) $count);
		$this->render->assign("count", $this->post_count());
		$this->render->assign("offset", $offset);
		$this->render->assign("step", $count);
		$this->render->assign("rows", $rows);
		return $this->render->show("sell_table");
	}

}
?>
