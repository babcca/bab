<?php
require_once(dirname(__file__).'/enviroment.php');
require_once(dirname(__file__).'/process_manager.php');
require_once(dirname(__file__).'/application_manager.php');
require_once(dirname(__file__).'/config_loader.php');

/* 
 * Hlavni staticka trida enginu, zde se registruji aplikace,
 * pohledy [GET pozadavky] a procesy [POST pozadavky].
 * Zpristupnuje konfiguracni soubor.
 */
class Main {
	/* Manager na udalosti, kontroler */
	public static $process_manager;
	/* Manager apliakci, zde se aplikace registruji, 
	 * aby se mohli volat z venku
	 */
	public static $application_manager;
	/* SectionObject udrzuje informace z konfiguracniho souboru */
	public static $config;

	/* Inicializace hlavnich promennych enginu */
	public static function __init__($config) {
		session_start();
		Enviroment::__init__();
		self::$config = new ConfigLoader($config);
		self::$process_manager = new ProcessManager();
		self::$application_manager = new AppManager();
		Enviroment::set_title(self::$config->main->basic_title);
	}
}
?>
