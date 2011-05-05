<?php

/* Vlozeni dulezitych knihoven */
require_once(dirname(__file__).'/lib/main.php');
require_once(dirname(__file__).'/lib/index.php');

/* Inicializace prostredi */
Main::__init__('config.ini');

/* Registrace aplikaci */
Main::$application_manager->register('basic_page');

/* Zobrazeni */
new Index();

?>
