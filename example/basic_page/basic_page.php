<?php

class basic_page {
	private $render;
	
	public function __construct() {
		$this->render = new Render('basic_page');
	}

	public function uvod() {
		Enviroment::set_title("Uvodni stranka");
		return $this->render->show("uvod.tpl");
	}

	public function popis() {
		Enviroment::set_title("Popis projektu");
		return $this->render->show("popis.tpl");
	}

}
?>
