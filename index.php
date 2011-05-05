<?php

/* Vlozeni dulezitych knihoven */
require_once(dirname(__file__).'/lib/main.php');
require_once(dirname(__file__).'/lib/index.php');

/* Inicializace prostredi */
Main::__init__(/* config file */);

/* Registrace aplikaci */
Main::$application_manager->register('example/test1');

/* Zobrazeni */
$i = new Index();
$i->show();
?>
