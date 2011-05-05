<?php
require_once(dirname(__file__).'/smarty/Smarty.class.php');

/* 
 * Render pro aplikace (smarty)
 * Slouzi pro vykresleni view
 */
class Render extends Smarty {
	private $application;
	public function __construct($folder = '') {
		parent::__construct();
		$this->application = Main::$config->main->app_dir.'/'.$folder;
		$this->template_dir = $this->application;
		$this->compile_dir =$this->application.'/templates_c';
		$this->config_dir = $this->application.'/configs';
		$this->cache_dir = $this->application.'/cache';
	}
	/* Vykresleni templatu ze slozky apliakce */
	public function show($view = '') {
		// kontrola $view
		if ($view) return parent::fetch($view.".tpl");
		return '';
	}
}
?>
