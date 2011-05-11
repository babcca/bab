<?php
require_once(dirname(__file__).'/event_process.php');
require_once(dirname(__file__).'/enviroment.php');

/**
 * Manager volani aplikaci a jejich registrovanych pohledu a procesu 
 */
class ProcessManager {
	private $process; /**< Spravce procesu */
	private $view; /**< Spravce pohledu */
	
	public function __construct() {
		$this->process = new EventProcess();
		$this->view = new EventProcess();
	}

	/**
	 *	Zpracovani POST pozadavku (procesu).
	 *	\param "app" nazev aplikace v POST pozadavku
	 *	\param "method" nazev metody v POST pozadavku
	 *	\return navratova hodnota procesu
	 */
	public function process_post() {
		$p_app = Enviroment::post("app");
		$p_mt = Enviroment::post("method");
		if (($p_app != null) && ($p_mt != null)) {
			return $this->process->process($p_app, $p_mt, "post");
		}
		return null;
	}
	
	/**
	 *	Zpracovani GET pozadavku (pohledu).
	 *	\param "app" nazev aplikace v GET pozadavku
	 *	\param "method" nazev metody v GET pozadavku
	 *	\return Vygenerovany pohled
	 */
	public function process_get() {
		$g_app = Enviroment::get("app");
		$g_mt = Enviroment::get("method");
		if ($g_app == null) $g_app = Main::$config->main->default_app;
		if ($g_mt == null) $g_mt = Main::$config->main->default_view;
		return $this->view->process($g_app, $g_mt, "get");
		
	}

	/**
	 *	Automaticke zpracovani pozadavku, rozhoduje se podle REQUEST_METHOD.
	 *	\param post_redirect ma-li se po post pozadvku presmerovat na sebe sama a vyprazdnit POST
	 */
	public function process($post_redirect = true) {
		$content = false;
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$content = $this->process_post();
			if ($post_redirect) Enviroment::redirect($_SERVER['REQUEST_URI']);
		} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$content = $this->process_get();
		}
		return $content;
	}	
	
	/**
	 *	Prime zpracovani view z aplikace.
	 *	\param $app Nazev aplikace
	 *	\param $view Metoda pro pro vykresleni pohledu
	 *	\return Vygenerovany pohled
	 */
	public function get_view($app, $view) {
		return $this->view->process($app, $view, "get"); 
	}

	/**
	 *	Registrace pohledu pro volani z venku
	 *	\param $app Nazev apliakce
	 *	\param $method Metoda pro vykresleni pohledu
	 *	\param $params (array) pole nazvu povinnych parametru metody
	 *	\param $optParams (array) pole nazvu volitelnych paramteru metody ("nazev"=>"defaultni hodnota")
	 *	\param $loginReq (bool) urcuje musi-li byt volajici zaregistrovan v systemu pro volani metody
	 *	\param $groupReq (array) urcuje v ktere skupiny muzou volat metodu
	 */
	public function register_view($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '') {
		$this->view->register_method($app, $method, $params, $optParams, $loginReq, $groupReq);
	}
	/**
	 *	Registrace procesu pro volani z venku
	 *	\param $app Nazev apliakce
	 *	\param $method Metoda pro vykresleni pohledu
	 *	\param $params (array) pole nazvu povinnych parametru metody
	 *	\param $optParams (array) pole nazvu volitelnych paramteru metody ("nazev"=>"defaultni hodnota")
	 *	\param $loginReq (bool) urcuje musi-li byt volajici zaregistrovan v systemu pro volani metody
	 *	\param $groupReq (array) urcuje v ktere skupiny muzou volat metodu
	 */
	public function register_process($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '') {
		$this->process->register_method($app, $method, $params, $optParams, $loginReq, $groupReq);
	}
}
?>
