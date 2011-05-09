<?php

/** 
 *	
 */
class EventProcess 
{
	private $_MT_LIST = array(); /**< Seznam registrovanych metod */
	
	/**
	 *	Registrace metody do prostredi
	 *	\param $app Nazev apliakce
	 *	\param $method Metoda pro vykresleni pohledu
	 *	\param $params (array) pole nazvu povinnych parametru metody
	 *	\param $optParams (array) pole nazvu volitelnych paramteru metody ("nazev"=>"defaultni hodnota")
	 *	\param $loginReq (bool) urcuje musi-li byt volajici zaregistrovan v systemu pro volani metody
	 *	\param $groupReq (array) urcuje v ktere skupiny muzou volat metodu
	 */
	public function register_method($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '') {
		if (!array_key_exists($method, $this->_MT_LIST)) {
			if (!method_exists($app, $method)) throw new Exception("Trida nevlastni metodu $method");
			$this->_MT_LIST[$method] = new process($app, $method, $params, $optParams, $loginReq, $groupReq, $app);
		} else {
			throw new Exception("Function $method is alredy registred");
		}
	}
	
	/**
	 *	Vytazeni strauktury ze seznamu metod
	 * 	\param $mtName nazev hledane motody
	 * 	\return instance process() nebo null pokud nenalezeno
	 */
	private function get_method($mtName) {
		if (array_key_exists($mtName, $this->_MT_LIST))
			return $this->_MT_LIST[$mtName];
		else
			return null;
	}
	
	/**
	 * 	Kontrola autorizace podle nastavenych pristupovych prav
	 * 	\param $process instance process nalezici kontrolovane metode \see get_method()
	 * 	\return true pri autorizaci jinak false
	 */
	private function autorization($process) {
		if ($app->LoginReq and !Enviroment::loged()) {
			return false;
		}
		return true;
		//if ($app->GroupReq != false) {
		//	foreach(Enviroment::SGGet("USER", "Group") as $g) {
		//		if (!in_array($g, $app->GroupReq))
		//			throw new UnautorizedExecution(__class__, __method__, Config::$ExceptionStrings[1]); 
		//	}
		//}			
	}
	
	/**
	 *	Zalohovani post parametru metody
	 *	\param $process instance process zalohovane metody \see get_method()
	 */
	public function backup_param($process) {
		$data = array();
		foreach ($process->Params as $param) {
			 $data[$param] = Enviroment::post($param);
		}
		foreach ($process->OptParams as $param => $def) {
				$val = Enviroment::post($param);
				$data[$param] = $val == Null ? $def : $val;
		}
		Enviroment::set_form_data($data);
	}	

	/**
	 *	Zavolani $ret = $app->$mt($source)
	 * 	\param $app Nazev tridy
	 * 	\param $mt Volana metoda
	 * 	\param $source Zdroj argumentu
	 * 	\return $ret nabo false pri chybe a nastaveni Enviroment::info
	 */
	public function process($app, $mt, $source) {
		// importovani aplikace
		if (!Main::$application_manager->import($app)) {
			Enviroment::set_info("Neznama aplikace");
			return false;
		}
		$process = $this->get_method($mt);
		if ($process != null) {
			// kontrola autorizace
			if (!$this->autorization($process)) {
				Enviroment::set_info("Musite byt prihaseni");
				return false;
			}
			// zalohovani post parametru (vhodne pro formulare)
			if ($source == "post") $this->backup_param($process);
			$params = array();
			$i = 0;
			// Parsovani povinnych parametru
			foreach ($process->Params as $param) {
				$val = Enviroment::param($source, $param);
				if ($val == null) {
					Enviroment::set_info("Nedostatek parametru ($param)");
					return false;
				}
				$params[$i++] = $val;		
			}
			// Parsovani nepovinnych parametru
			foreach ($process->OptParams as $param => $def) {
				$val = Enviroment::param($source, $param);
				$params[$i++] = $val == Null ? $def : $val;		
			}
			$obj = new $process->Class();
			return call_user_func_array(array($obj, $process->Method), $params);
		} else {
			Enviroment::set_info("Neznama funkce $mt");
			return false;
		}
	}
	
	/**
	 * Vypis registrovanych metod
	 */
	public function _debug() {
		var_dump($this->_MT_LIST);
	}
}

/**
 * Struktura zapouzdrujici informace o registrovane metode
 */
class process
{
	public $Class;
	public $Method; 
	public $Params;
	public $OptParams;
	public $ParamsCount;
	public $LoginReq;
	public $GroupReq;
	public $AppName;
		
	public function __construct($class, $method, $params, $optParams, $loginReq, $groupReq, $appName)
	{
		$this->Class = $class;
		$this->Method = $method;
		$this->Params = $params;
		$this->OptParams = $optParams;
		$this->ParamsCount = count($params);
		$this->LoginReq = $loginReq;
		$this->GroupReq = $groupReq;
		$this->AppName = $appName;
	}
}

?>
