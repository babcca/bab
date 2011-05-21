<?php
require_once(dirname(__file__).'/../../lib/main.php');
require_once(dirname(__file__).'/../../lib/entrypoints/index.php');
require_once(dirname(__file__).'/index.php');

/** exportovani entry pointu aplikace */
Main::$process_manager->register_view("index", "main", array(), array("charset"=>"UTF-8"));
Main::$process_manager->register_view("index", 'popis');
Main::$process_manager->register_view("index", "uvod");

?>