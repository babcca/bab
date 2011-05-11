<?php
require_once(dirname(__file__).'/../render.php');
require_once(dirname(__file__).'/../ientrypoint.php');

class IndexEntry implements IEntrypoint {
	protected $render;
	public function __construct($template_dir) {
		$this->render = new Render($template_dir);
	}
	
	public function main($charset) {
		header("Content-type: text/html; charset=$charset");
		$content = Main::$process_manager->process(false);
		if (!$content) {
			return $this->on_error($charset);
		} else {
			return $this->on_succes($charset, $content);
		}
	}

	public function on_error($charset) {
		Enviroment::set_title("Nastala chyba");
		$this->render->assign("charset", $charset);
		$this->render->assign("error", Enviroment::get_error());
		return $this->render->show('error');	
	}

	public function on_succes($charset, $content) {
		$this->render->assign("title", Enviroment::get_title());
		$this->render->assign("charset", $charset);
		$this->render->assign("content", $content);
		$this->render->assign("info", Enviroment::get_info());
		$this->render->assign("loged", Enviroment::loged());
		return $this->render->show('index');
	}
}
?>
