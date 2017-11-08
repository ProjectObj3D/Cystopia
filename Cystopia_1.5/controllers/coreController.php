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

	public function getParams($key = false){ return $this->_params[$key]; }
	public function setParams(array $params){ $this->_params = $params; }

	public function getData(){ return $this->_data; }
	public function setData(array $data){ $this->_data = $data; }


	public function callAction($action)
    {
		// $action = str_replace(' ', '', lcfirst(ucwords(strtolower($actionName)))) . 'Action';

        $actionMethod = $action.'Action';

        if(method_exists($this, $actionMethod))
        {
            $this->$actionMethod();
        }
    }


    
}
