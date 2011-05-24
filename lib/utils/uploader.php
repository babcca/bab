<?php
class Uploader {
	protected $source;
	protected $target;
	public function __construct($sourcei, $target) {
		$this->source = $source;
		$this->target = $target.basename($_FILES[$this->source]['name']);
	}

	public function Upload() {
		$this->file_check();
		if (move_uploaded_file($_FILE[$this->source]['tmp_name'], $this->target)) {
			return true;
		} else {
			return false;
		}
		return $new_name;
	}




	private function file_check() {
		return true;
	}
}
?>
