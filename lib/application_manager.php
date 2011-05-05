<?php
class AppManager {
  private $_APP_LIST;
  
  public function register($app) {
    $this->_APP_LIST[$app] = false;
  }
  public function import($app) {
    if (array_key_exists($app, $this->_APP_LIST)) {
      if (!$this->_APP_LIST[$app]) {
        require(dirname(__file__)."/../app/$app/$app.include.php");
        $this->_APP_LIST[$app] = true;
      }
      return true;
    }
    return false;

  }
}
?>
