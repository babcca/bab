<?php
require_once(dirname(__file__).'/../../lib/main.php');
require_once(dirname(__file__).'/../../lib/render.php');
require_once(dirname(__file__).'/sell.php');


/** pohledy pro prodej */
Main::$process_manager->register_view("sell", "post_list", array(), array("offset"=>0, "count"=>4));

/** metody pro prodej */
Main::$process_manager->register_process("sell", "post_new_", array("title", "description", "price"), array("image"=>"/img/default.png"));
Main::$process_manager->register_process("sell", "deactive_post_", array("post_id"));//, array(), true);
Main::$process_manager->register_process("sell", "check_state_", array("timestamp")); 

?>

