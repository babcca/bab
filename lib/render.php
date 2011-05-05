<?php
require_once(dirname(__file__).'/smarty/Smarty.class.php');

class Render extends Smarty {
  private $aplication;
  public function __construct($folder = '') {
    parent::__construct();
    $this->aplication = $folder;
    $this->template_dir = './html/templates/'.$folder;
    $this->compile_dir ='./html/templates_c';
    $this->config_dir = './html/configs';
    $this->cache_dir = './html/cache';
  }
  public function fetch($view = '') {
    // kontrola $view
    if (!$view) $view = $this->aplication;
    return parent::fetch($view.".tpl");
  }
}
?>
