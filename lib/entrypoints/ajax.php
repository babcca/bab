<?php
require_once(dirname(__file__).'/../render.php');
require_once(dirname(__file__).'/../ientrypoint.php');

class AjaxEntry implements IEntrypoint {
	protected $render;
	public function __construct($template_dir) {
		$this->render = new Render($template_dir);
	}
	
	public function main() {
		$content = Main::$process_manager->process(false);
		if (!$content) {
			return $this->on_error();
		} else {
			return $this->on_succes($content);
		}
	}

	public function on_error() {
		return json_encode(Enviroment::get_error());	
	}

	public function on_succes($content) {
		return $content;
	}
}
?>
