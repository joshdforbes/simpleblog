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
		try {
			$this->setController();
			$this->setAction();
			$this->setParameters();
		} catch (\Exception $e) {
			$this->controller = __NAMESPACE__ . '\\' . 'ErrorController';
			$this->action = 'notFoundAction';
			$this->parameters = (array)$e;
		}		
	}

	public function setController()
	{
		$controller = ucfirst(strtolower($this->request->getController())) . 'Controller';
		$controller = __NAMESPACE__ . '\\' . $controller;
		if (class_exists($controller)) {
			$this->controller = $controller;
			return $this;
		}
		Throw new \Exception('Controller not found');
	}

	public function setAction()
	{
		$action = strtolower($this->request->getAction()) . 'Action';
		if (method_exists($this->controller, $action)) {
			$this->action = $action;
			return $this;
		}
		Throw new \Exception('Action not found');
	}

	public function setParameters()
	{
		$this->parameters = $this->request->getParameters();
	}

	public function dispatch()
	{
		call_user_func_array(array(new $this->controller($this->connection), $this->action), $this->parameters);
	}


}

