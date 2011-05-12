<?php
require_once(dirname(__file__).'/smarty/Smarty.class.php');

/** 
 *	Render pro aplikace (smarty)
 * 	Slouzi pro vykresleni view casti aplikace
 */
class Render extends Smarty {
	private $application; /**< Slozka plikace */
	/**
	 * 	Inicializace smarty, kazda aplikace ma svoji slozku pro templaty
	 *	\param $folder Slozka aplikace, kde je umistena slozka template se smarty strukturou
	 */
	public function __construct($folder) {
		parent::__construct();
		$this->application = dirname(__file__)."/".Main::$config->main->app_dir.'/'.$folder.'/templates';
		$this->template_dir = $this->application.'/templates';
		$this->compile_dir =$this->application.'/templates_c';
		$this->config_dir = $this->application.'/configs';
		$this->cache_dir = $this->application.'/cache';
		$this->registerPlugin("function", "before_time", "Render::get_before_time");
	}

	/**
	 *	Vykresleni templatu ze slozky apliakce
	 *	\param $view Nazev templatu (bez koncovky .tpl)
	 */
	public function show($view) {
		// kontrola $view
		if ($view) return parent::fetch($view.".tpl");
		return '';
	}

	public static function get_before_time($params, $smarty) {
		$r = array();
		$r["s"] = (int) time() - $params["time"];
		$r["m"] = (int) ($r["s"] / 60);
		$r["h"] = (int) ($r["m"] / 60);
		$r["d"] = (int) ($r["h"] / 24);
		
		if ($r["d"] != 0) {
			if ($r["d"] == 1) return "dnem";
			else return $r["d"]." dny";
		} else 	if ($r["h"] != 0) {
			if ($r["h"] == 1) return "hodinou";
			else return $r["h"]." hodinami";
		} else 	if ($r["m"] != 0) {
			if ($r["m"] == 1) return "minutou";
			else return $r["m"]." minutami";
		} else 	if ($r["s"] != 0) {
			if ($r["s"] == 1) return "vterinou";
			else return $r["s"]." vterinami";
		} 
		
	}
}
?>
