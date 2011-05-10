<?php
require_once(dirname(__file__).'/mysql.php');

/**
 *	Staticka trida pracujici s vnejsim prostredim
 *	je doporucene pristupovat k superglobalnim promenim (GET, POST, SESSION)
 *	pres toto rohrani.
 */
class Enviroment {
	public static $db;
	private static $info_msg;
	public static function __init__() {
		//self::$db = new MySql("mysql.webzdarma.cz", "testovatko", "testovatko", "t7rkue");
	}

	/** 
	 *	Pristup k superglobalni promenne GET
	 *	\param $name Nazev polozky
	 *	\return $_GET[$name] nebo null, pokud neobsahuje $name
	 */
	public static function get($name) {
		if (isset($_GET[$name])) return $_GET[$name];
		return null;
	}
	
	/** 
	 *	Pristup k superglobalni promenne POST
	 *	\param $name Nazev polozky
	 *	\return $_POST[$name] nebo null, pokud neobsahuje $name
	 */
	public static function post($name) {
		if (isset($_POST[$name])) return $_POST[$name];
		return null;
	}
	
	/** 
	 *	Zpristupneni superglobalnich poli POST a GET
	 *	\param $source Zdroj dat (POST|GET)
	 *	\param $name Nazev polozky
	 *	\return $_$source[$name] nebo null, pokud neobsahuje $name
	 */
	public static function param($source, $name) {
		if (strtolower($source) == "get") return self::get($name);
		if (strtolower($source) == "post") return self::post($name);
		return null;
	}

	/**
	 *	Escapovani retezce pro sql dotaz a odstraneni html tagu
	 *	\param $str Retezec kescapovani
	 *	\return Escapovany retezec
	 */
	public function escape($str) {
		return mysql_escape_string(nl2br(htmlspecialchars($str)));
	}

	/**
	 *	Kontrola je-li uzivatel prihlasen,
	 *	po prihlasnei uzivatele je nutne zavolat interni funkci login($id)
	 *	\return true je-li uzivatel prihlasen, jinak false
	 */
	public static function loged() {
		if (isset($_SESSION["user"])) return true;
		return false;
	}

	/**
	 *	Interni prihlasnei uzivatele, je nutne pro volani metod,
	 *	ktere vyzaduji prihlaseneho uzivatel
	 *	\param $id Id uzivatele
	 */
	public static function login($id) {
		$_SESSION["user"]["loged"] = true;
		$_SESSION["user"]["id"] = $id;
	}
	
	/**
	 *	Interni odhlaseni uzivatele 
	 */
	public static function logout() {
		if(isset($_SESSION["user"])) unset($_SESSION["user"]);
	}
	
	/**
	 * 	\return Id prihlaseneho uzivate, zadane pri volani login($id). -1 pokud nebyl uzivatel prihlasen
	 */
	public static function get_user_id() {
		if (isset($_SESSION["user"])) return $_SESSION["user"]["id"];
		return -1;
	}

	/**
	 *	Perzistetni ulozeni dat z POST pozadavku
	 */
	public static function set_form_data($data = array()) {
		$_SESSION["form_data"] = $data;
	}

	/**
	 *	Nacteni POST dat z perzistentniho uloziste
	 *	\return Nactena data
	 */
	public static function get_form_data() {
		$data = array();
		if(isset($_SESSION["form_data"])) $data = $_SESSION["form_data"];
		unset($_SESSION["form_data"]);
		return $data;
	}
	
	/**
	 *	Ulozeni informace do perzistentniho uloziste, 
	 *	vhodne pro vypisovani informacnich hlasek z aplikace
	 *	\param $info Ukladane informace
	 */
	public static function set_info($info) { $_SESSION["__info"] = $info; }
	
	/**
	 *	Ziskani ulozene informace z perzistentniho uloziste
	 *	\return Ulozena data
	 */
	public static function get_info() {
		$info = "";
		if(isset($_SESSION["__info"])) $info = $_SESSION["__info"]; 
		unset($_SESSION["__info"]);
		return $info;
	}
	/**
	 *	Ulozeni informace o chybe do perzistentniho uloziste, 
	 *	vhodne pro vypisovani informacnich hlasek z aplikace
	 *	\param $info Ukladane informace
	 *	\param $id Id chyby
	 */
	public static function set_error($info, $id) { 
		$_SESSION["__errormsg"] = $info; 
		$_SESSION["__errorno"] = $id;
	}
	
	/**
	 *	Ziskani ulozene informace o chybe z perzistentniho uloziste
	 *	\return Ulozena data array(errmsg, errno);
	 */
	public static function get_error() {
		$info = false;
		if(isset($_SESSION["__errormsg"])) $info = array($_SESSION["__errormsg"], $_SESSION["__errorno"]);
		unset($_SESSION["__errormsg"]);
		unset($_SESSION["__errorno"]);
		return $info;
	}

	/**
	 *	Nastaveni titulku okna
	 *	\param $title Titulek okna
	 */
	public static function set_title($title) { $_SESSION["title"] = $title;}
	
	/**
	 *	\return Ulozeny titulek okna
	 */
	public static function get_title() { return $_SESSION["title"]; }
	
	/**
	 *	Presmerovani na pozadovanou stranku, vice moznosti presmerovani 
	 *	a okamzite ukonceni vykonvani scriptu
	 *	\param $url Adresa kam se ma presmerovat
	 *	\param $javascript Ma-li se pouzit k presmerovani javascript
	 */
	public static function redirect($url, $javascript = false) {
		if (!$javascript) header("Location: $url");
		else echo "<script>top.location=\"$url\"</script>";
		exit;
	}
	/**
	 *	Vytvoreni URL pro zadanou aplikaci a jeji argumenty
	 *	\param $app Nazev aplikace
	 *	\param $method Volana metoda
	 *	\param $params (array) pole argumentu, se kterymi se metoda vola ("nazev"=>"hodnota")
	 *	\param $bootstrap Vstupni bod aplikace (index, ajax)
	 *	\return Vytvorene URL
	 */
	public static function make_url($app, $method, $params = array(), $bootstrap="index") {
		$url = "/$bootstrap.php?app=$app&method=$method";
		foreach ($params as $key => $val) {
			$url .= "&$key=$val";
		}
		return $url;
	}
}

?>
