<?php

/* Vlozeni dulezitych knihoven */
require_once(dirname(__file__).'/lib/main.php');

/* Inicializace prostredi */
Main::__init__('config.ini');

/* Registrace aplikaci */
Main::$application_manager->register('sell');

/* Zobrazeni */
try {
	echo Main::$process_manager->process(false);
} catch (Exception $e) {
	echo "Exception: ". $e->getMessage() ."\n";
}

?>
