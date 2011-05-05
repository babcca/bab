<?php
require_once(dirname(__file__).'/event_process.php');
require_once(dirname(__file__).'/enviroment.php');

class ProcessManager {
	/* Spravce procesu */
	private $process;
	/* Spravce pohledu */
	private $view;
	
	public function __construct() {
		$this->process = new EventProcess();
		$this->view = new EventProcess();
	}

	/* Zpracovani procesu */
	public function process_post() {
		$p_app = Enviroment::post("app");
		$p_mt = Enviroment::post("method");
		if (($p_app != null) && ($p_mt != null)) {
			$this->process->process($p_app, $p_mt, "post");
		}
	}
	
	/* Zpracovani pohledu */
	public function process_get() {
		$g_app = isset(Enviroment::get("app")) : Enviroment::get("app") ? Main::$config->main->default_app;
		if (($g_app != null)) {
			$g_mt = isset(Enviroment::get("method")) : Enviroment::get("method") ? Main::$config->main->default_view;
			return $this->view->process($g_app, $g_mt, "get");
		}
	}

	/* Automaticke zpracovani pozadavku, rozhoduje se podle REQUEST_METHOD */
	public function process($post_redirect = true) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->process_post();
			if ($post_redirect) Enviroment::redirect($_SERVER['REQUEST_URI']);
		} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			return $this->process_get();
		}
	}	
	
	/* Prime zpracovani view z apliakce */
	public function get_view($app, $view) {
		return $this->view->process($app, $view, "get"); 
	}
	/* Zpristupneni view ven */
	public function register_view($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '') {
		$this->view->register_method($app, $method, $params, $optParams, $loginReq, $groupReq);
	}
	/* Zpristupneni procesu */
	public function register_process($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '') {
		$this->process->register_method($app, $method, $params, $optParams, $loginReq, $groupReq);
	}
}


?>
