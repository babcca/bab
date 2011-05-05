<?php
  class EventProcess 
  {
    private $_MT_LIST = array();
    
    /* 
      RegistrFunction($fnName, $class, $method, $type, $params)     
      $params = array ( "paramName" )
      $type = GET|POST
    */
    public function register_method($app, $method, $params = array(), $optParams = array(), $loginReq = false, $groupReq = '')
    {
      if (!array_key_exists($method, $this->_MT_LIST)) {
        // Kontrola nalezitosti funkce k tride
        $this->_MT_LIST[$method] = new process($app, $method, $params, $optParams, $loginReq, $groupReq, $app);
      } else {
        die("Function $method is alredy registred");
      }
    }
    
    private function get_method($mtName)
    {
      if (array_key_exists($mtName, $this->_MT_LIST))
        return $this->_MT_LIST[$mtName];
      else
        return null;
    }
    
    private function autorization($app)
    {
      if ($app->LoginReq and !Enviroment::loged()) {
        return false;
      }
      return true;
      //if ($app->GroupReq != false) {
      //  foreach(Enviroment::SGGet("USER", "Group") as $g) {
      //    if (!in_array($g, $app->GroupReq))
      //      throw new UnautorizedExecution(__class__, __method__, Config::$ExceptionStrings[1]); 
      //  }
      //}      
    }
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
    public function process($app, $mt, $source)
    {
      if (!Main::$application_manager->import($app)) {
        Enviroment::set_info("Neznama aplikace");
        return false;
      }
      $process = $this->get_method($mt);
      if ($process != null) {
        if (!$this->autorization($process)) {
	  Enviroment::set_info("Musite byt prihaseni");
	  return false;
	}
        if ($source == "post") $this->backup_param($process);
        $params = array();
        $i = 0;
        foreach ($process->Params as $param) {
          $val = Enviroment::param($source, $param);
          if ($val == null) {
            Enviroment::set_info("Nedostatek parametru ($param)");
            return false;
          }
          $params[$i++] = $val;    
        }
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
       
    public function _debug()
    {
      var_dump($this->_MT_LIST);
    }
  }
  
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
