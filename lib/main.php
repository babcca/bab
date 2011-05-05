<?php
require_once(dirname(__file__).'/enviroment.php');
require_once(dirname(__file__).'/process_manager.php');
require_once(dirname(__file__).'/application_manager.php');
class Main {
  public static $process_manager;
  public static $application_manager;
  
  public static function __init__() {
    session_start();
    Enviroment::__init__();
    Enviroment::set_title("zakladni titulek");
    self::$process_manager = new ProcessManager();
    self::$application_manager = new AppManager();
  }

}
?>
