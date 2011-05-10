<?php
/** 
 * Reprezentace jednotlivych sekci
 * umoznuje pristup k promennym sekce za pomoci 
 * operatoru ->
 */
class SectionObject {
	private $section;
	public function __construct($section) {
		$this->section = $section;
	}
	public function __toString() {
		if (!is_array($this->section)) return $this->section;
		else return print_r($this->section, true);
	}
	/**
	 * Predefinovani operatoru ->
	 * \param $option prava strana ->
	 */
	public function __get($option) {
		if (array_key_exists($option, $this->section)) {
			if (is_array($this->section[$option])) return new SectionObject($this->section[$option]);
			else return $this->section[$option];
		}
		return null;
	}
}
/**
 * Nacteni konfiguracniho souboru,
 * poskytuje primi pristup k promennym za pomoci operatoru ->
 */

class ConfigLoader {
	/* nazev konfiguracniho souboru */
	private $config_file = '';
	/* koren konfiguracniho souboru */
	private $root;

	public function __construct($config_file) {
		$this->config_file = $config_file;
		if (file_exists($this->config_file)) {
			$this->root = new SectionObject(parse_ini_file($this->config_file, true));
		} else {
			throw new Exception("Config file {$this->config_file} not found");
		}
	}
	/**
	 * Predefinovani operatoru ->
	 * \param $option prava strana ->
	 */
	public function __get($option) {
		return $this->root->$option;
	}
}
?>
