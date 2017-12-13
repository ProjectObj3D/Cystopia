<?php


class coreController{


	private $_params = array();
	private $_data = array();
	private $_model;

	public function __construct()
    {
		$className = get_class($this);
		$modelName = substr($className, 0, -10);
		$modelName .= 'Model';
		$this->_model = new $modelName();
	}

	protected function getModel(){ return $this->_model; }

	public function getArray(array $params, $key){ return $this->_params[$key];}

	public function getParams($key = false)
    {
        if($key === false)
        {
            return $this->_params;
        }
        return $this->_params[$key];
    }
	public function setParams(array $params){ $this->_params = $params; }

	public function getData($key = false)
    {
        if($key === false)
        {
            return $this->_data;
        }
        return $this->_data[$key];
    }
	public function setData(array $data){ $this->_data = $data; }


	public function callAction($action)
    {
		// $action = str_replace(' ', '', lcfirst(ucwords(strtolower($actionName)))) . 'Action';

        $actionMethod = $action.'Action';

        if(method_exists($this, $actionMethod))
        {
            $this->$actionMethod();
        }
        else
        {
            include 'views'.DIRECTORY_SEPARATOR.'errors'.DIRECTORY_SEPARATOR.'404.php';
        }
    }


    
}
