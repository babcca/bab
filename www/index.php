<?php
define('LIB_DIR', dirname(__file__).'/../lib/');
/* Vlozeni dulezitych knihoven */
require_once(LIB_DIR.'/main.php');

/* Inicializace prostredi */
Main::__init__('../config.ini');

/* Registrace aplikaci */
Main::$application_manager->register('index');
Main::$application_manager->register('sell');

/* Zobrazeni */
try {
	echo Main::$process_manager->get_view(Main::$config->main->main_app, "main");
} catch (Exception $e) {
	echo "Exception: ". $e->getMessage() ."\n";
}

?>
