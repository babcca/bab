<?php

require_once(dirname(__file__).'/../main.php');

interface Entrypoint {
	public function main($charset);
}

class IndexEntry {
	protected $render;
	public function __construct($template) {
		echo "my kontruktor\n";
		$this->render = new Render($template);
	}
	
	public function main($charset) {
		header("Content-type: text/html; charset=$charset");
		$content = Main::$process_manager->process();
		if (!$content) {
			echo "no kontent\n";				
		}

		$this->render->assign("title", Enviroment::get_title());
		$this->render->assign("charset", $charset);
		$this->render->assign("content", $content);
		$this->render->assign("info", Enviroment::get_info());
		$this->render->assign("loged", Enviroment::loged());
		return $this->render->show('index');
	}
}
?>
