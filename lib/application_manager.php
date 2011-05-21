<?php

/**
 * Spravce registrovanych aplikaci, kazda aplikace se musi zaregistrovat,
 * aby bylo mozne ji volat z venku
 */

class AppManager {
	private $_APP_LIST; /**< Seznam registrovanych aplikaci */
	
	/**
	 * Registrace aplikace
	 * \param $app Nazev aplikace
	 */
	public function register($app) {
		$this->_APP_LIST[$app] = false;
	}
	
	/**
	 * Importovani aplikace, system importuje jen aplikace ktere jsou potreba
	 * \param $app Nazev importovane aplikace
	 */
	public function import($app) {
    if (array_key_exists($app, $this->_APP_LIST)) {
			if (!$this->_APP_LIST[$app]) {
				require(dirname(__file__)."/".Main::$config->main->app_dir."/$app/$app.include.php");
				$this->_APP_LIST[$app] = true;
			}
			return true;
		}
		return false;
	}
}
?>
