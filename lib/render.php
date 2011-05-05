<?php
require_once(dirname(__file__).'/smarty/Smarty.class.php');

class Render extends Smarty {
	private $aplication;
	public function __construct($folder = '') {
		parent::__construct();
		$this->aplication = $folder;
		$this->template_dir = $this->application;
		$this->compile_dir =$this->application.'/templates_c';
		$this->config_dir = $this->application.'/configs';
		$this->cache_dir = $this->application.'/cache';
	}
	public function fetch($view = '') {
		// kontrola $view
		if (!$view) $view = $this->aplication;
		return parent::fetch($view.".tpl");
	}
}
?>
