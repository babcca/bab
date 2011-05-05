<?php
require_once(dirname(__file__).'/event_process.php');
require_once(dirname(__file__).'/enviroment.php');

class ProcessManager {
  private $process;
  private $view;
  public function __construct() {
    $this->process = new EventProcess();
    $this->view = new EventProcess();
  }
  public function process_post() {
    $p_app = Enviroment::post("app");
    $p_mt = Enviroment::post("method");
    if (($p_app != null) && ($p_mt != null)) {
      $this->process->process($p_app, $p_mt, "post");
    }
  }
  
  public function process_get() {
    $g_app = Enviroment::get("app");
    if (($g_app != null)) {
      $g_mt = Enviroment::get("method");
      if ($g_mt == "") $g_mt = "Render"; // default view
      return $this->view->process($g_app, $g_mt, "get");
    }
  }
  public function process() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->process_post();
      Enviroment::redirect($_SERVER['REQUEST_URI']);
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      return $this->process_get();
    }
  }  
  
  public function get_view($app, $view) {
    return $this->view->process($app, $view, "get"); 
  }
  public function register_view($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '') {
    $this->view->register_method($app, $method, $params, $optParams, $loginReq, $groupReq);
  }
  public function register_process($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '') {
    $this->process->register_method($app, $method, $params, $optParams, $loginReq, $groupReq);
  }
}


?>
