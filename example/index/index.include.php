<?php
  require_once(dirname(__file__).'/../../lib/main.php');
  require_once(dirname(__file__).'/../../lib/render.php');
  require_once(dirname(__file__).'/index.php');

  /** exportovani entry pointu aplikace */
  Main::$process_manager->register_view("index", "main", array(), array("charset"=>"UTF-8"));
?>

