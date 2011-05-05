<?php
require_once(dirname(__file__).'/mysql.php');

class Enviroment {
  public static $db;
  private static $info_msg;
  public static function __init__() {
     self::$db = new MySql("mysql.webzdarma.cz", "testovatko", "testovatko", "t7rkue");
  }
  public static function get($name) {
    if (isset($_GET[$name])) return $_GET[$name];
    return false;
  }
  public static function post($name) {
    if (isset($_POST[$name])) return $_POST[$name];
    return null;
  }
  public static function param($source, $param) {
    if (strtolower($source) == "get") return self::get($param);
    if (strtolower($source) == "post") return self::post($param);
    return null;
  }
  public function escape($str) {
    return mysql_escape_string(nl2br(htmlspecialchars($str)));
  }
  public static function loged() {
    if (isset($_SESSION["user"])) return true;
    return false;
  }
  public static function login($id) {
    $_SESSION["user"]["loged"] = true;
    $_SESSION["user"]["id"] = $id;
  }
  public static function logout() {
    if(isset($_SESSION["user"])) unset($_SESSION["user"]);
  }
  public static function get_user_id() {
    if (isset($_SESSION["user"])) return $_SESSION["user"]["id"];
    return -1;
  }
  public static function set_form_data($data = array()) {
    $_SESSION["form_data"] = $data;
  }
  public static function get_form_data() {
    $data = array();
    if(isset($_SESSION["form_data"])) $data = $_SESSION["form_data"];
    unset($_SESSION["form_data"]);
    return $data;
  }
  public static function set_info($info) { $_SESSION["info"] = $info; }
  public static function get_info() {
    $info = "";
    if(isset($_SESSION["info"])) $info = $_SESSION["info"]; 
    unset($_SESSION["info"]);
    return $info;
  }
  public static function set_title($title) { $_SESSION["title"] = $title;}
  public static function get_title() { return $_SESSION["title"]; }
  public static function redirect($url) { header("Location: $url"); exit;}
  public static function make_url($app, $method, $params = array()) {
    $url = "/index.php?app=$app&method=$method";
    foreach ($params as $key => $val) {
      $url .= "&$key=$val";
    }
    return $url;
  }
}

?>
