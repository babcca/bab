<?php

/* Vlozeni dulezitych knihoven */
require_once(dirname(__file__).'/lib/main.php');

/* Inicializace prostredi */
Main::__init__('config.ini');

/* Registrace aplikaci */
Main::$application_manager->register('index');
Main::$application_manager->register('basic_page');

/* Zobrazeni */
echo Main::$process_manager->get_view(Main::$config->main->main_app, "main");
?>
