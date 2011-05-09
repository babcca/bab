<?php
require_once(dirname(__file__).'/enviroment.php');
require_once(dirname(__file__).'/process_manager.php');
require_once(dirname(__file__).'/application_manager.php');
require_once(dirname(__file__).'/config_loader.php');

/** 
 *	Hlavni staticka trida enginu, zde se registruji aplikace,
 * 	pohledy [GET pozadavky] a procesy [POST pozadavky].
 * 	Zpristupnuje konfiguracni soubor.
 */
class Main {
	public static $process_manager; /**< Manager na udalosti */
	public static $application_manager; /**< Manager aplikaci, jen registrovane aplikace je mozne volat */
	public static $config; /**< Udrzuje informace z konfiguracniho souboru */

	/**
	 *	Inicializace hlavnich promennych enginu 
	 */
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
