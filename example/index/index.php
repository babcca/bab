<?php

class index {
	private $render;
	public function __construct() {
		$this->render = new Render('index');
	}
	
	public function main($charset) {
		header("Content-type: text/html; charset=$charset");
		$content = Main::$process_manager->process();
		if (!$content) {
/*			if (Enviroment::loged()) { 
				Enviroment::set_title('Testovátko');
				$content = $this->render->fetch('uvod');
			} else {
				Enviroment::set_title('Prihlasnei');
				$content = Main::$process_manager->get_view("prihlaseni", "formular");
			}
*/		}
		$this->render->assign("title", Enviroment::get_title());
		$this->render->assign("content", $content);
		$this->render->assign("info", Enviroment::get_info());
		$this->render->assign("loged", Enviroment::loged());
		return $this->render->show('index');
	}
}
?>
