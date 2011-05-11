<?php

class index extends IndexEntry {
	public function __construct() {
		parent::__construct('index');
	}

	public function uvod() {
		Enviroment::set_title("Uvodni stranka");
		return $this->render->show("uvod");
	}

	public function popis() {
		Enviroment::set_title("Popis projektu");
		return $this->render->show("popis");
	}
}
?>
