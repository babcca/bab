<?php
require_once(dirname(__file__).'/enviroment.php');
require_once(dirname(__file__).'/render.php');
require_once(dirname(__file__).'/main.php');

class Index {
	private $render;
	private $charset;
	public function __construct($charset='UTF-8') {
		$this->render = new Render('index');
		$this->charset = $charset;
		$this->show();
	}
	
	public function show() {
		header("Content-type: text/html; charset={$this->charset}");
		$content = Main::$process_manager->process();
		if (!$content) {
			if (Enviroment::loged()) { 
				Enviroment::set_title('Testovátko');
				$content = $this->render->fetch('uvod');
			} else {
				Enviroment::set_title('Prihlasnei');
				$content = Main::$process_manager->get_view("prihlaseni", "formular");
			}
		}
		$this->render->assign("title", Enviroment::get_title());
		$this->render->assign("content", $content);
		$this->render->assign("info", Enviroment::get_info());
		$this->render->assign("loged", Enviroment::loged());
		echo $this->render->show('index');
	}
}
?>
