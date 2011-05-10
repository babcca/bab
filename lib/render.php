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
}
?>
