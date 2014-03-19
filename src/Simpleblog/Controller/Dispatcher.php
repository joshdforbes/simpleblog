<?php
namespace Simpleblog\Controller;

class Dispatcher
{
	private $request;
	private $connection;

	public function __construct(Request $request, \PDO $connection)
	{
		$this->request = $request;
		$this->connection = $connection;	
	}

	public function setController($controller = null)
	{
		$controller = ($controller === null) ? $this->request->getController() : $controller;
		
		$controller = ucfirst(strtolower($controller)) . 'Controller';
		$controller = __NAMESPACE__ . '\\' . $controller;
		if (class_exists($controller)) {
			$this->controller = $controller;
			return $this;
		}
		Throw new \Exception('Controller not found');
	}

	public function setAction($action = null)
	{
		if ($action === null) {
			$action = strtolower($this->request->getAction()) . 'Action';
		} else {
			$action = strtolower($action) . 'Action';
		}
		
		if (method_exists($this->controller, $action)) {
			$this->action = $action;
			return $this;
		}
		Throw new \Exception('Action not found');
	}

	public function setParameters($parameters = null)
	{
		if ($parameters === null) {
			$this->parameters = $this->request->getParameters();
		} else {
			$this->parameters = $parameters;
		}
	}

	public function init()
	{
		$this->setController();
		$this->setAction();
		$this->setParameters();
	}

	public function dispatch()
	{
		call_user_func_array(array(new $this->controller($this->request, $this->connection), $this->action), $this->parameters);
	}


}

