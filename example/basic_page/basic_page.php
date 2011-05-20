<?php
/**
 *	Zakladni kostra jednoduche stranky
 *	Jakoby staticke stranky (co odkaz to stranka [template]).
 *	[pridat predavani dat z formulare
 */
class basic_page extends IndexEntry {	
	public function __construct() {
		parrent::__construct('basic_page');
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
