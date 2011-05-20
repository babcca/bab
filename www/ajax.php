<?php
define('LIB_DIR', dirname(__file__).'/../lib/');
/* Vlozeni dulezitych knihoven */
require_once(LIB_DIR.'/main.php');

/* Inicializace prostredi */
Main::__init__('../config.ini');

/* Registrace aplikaci */
Main::$application_manager->register('sell');

/* Zobrazeni */
try {
	echo Main::$process_manager->process(false);
} catch (Exception $e) {
	echo "Exception: ". $e->getMessage() ."\n";
}

?>
