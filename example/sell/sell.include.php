<?php
require_once(dirname(__file__).'/../../lib/main.php');
require_once(dirname(__file__).'/sell.php');


/** pohledy pro prodej */
Main::$process_manager->register_view("sell", "post_new");
Main::$process_manager->register_view("sell", "post_list");

/** metody pro prodej */
Main::$process_manager->register_process("sell", "post_new_", array("title", "description", "price"), array("image"=>"/img/default.png"));


?>

