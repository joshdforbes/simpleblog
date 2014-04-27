<?php
namespace Simpleblog\Controller;

class Dispatcher
{
	/**
	 * Request object
	 * 
	 * @var Request
	 */
	private $request;

	/**
	 * database connection
	 * 
	 * @var PDO
	 */
	private $connection;

	/**
	 * constructor. Injected with Request and PDO objects
	 * 
	 * @param Request $request    
	 * @param PDO     $connection 
	 */
	public function __construct(Request $request, \PDO $connection)
	{
		$this->request = $request;
		$this->connection = $connection;	
	}

	/**
	 * either takes controller argument or if null retrieves the controller from the request object
	 * puts the controller in the proper format for the framework (ucfirst and adding the namespace)
	 * checks to see if the class exists
	 * 
	 * @param string $controller either a supplied argument or if null - $request->getController()
	 * @return $this|Exception
	 * @throws Exception If the controller class doesn't exist - routes to errorController
	 */
	public function setController($controller = null)
	{
		$controller = ($controller === null) ? $this->request->getController() : $controller;
		
		$controller = ucfirst(strtolower($controller)) . 'Controller';
		$controller = __NAMESPACE__ . '\\' . $controller;
		if (class_exists($controller)) {
			$this->controller = $controller;
			return $this;
		}
		Throw new \Exception('notFound');
	}

	/**
	 * takes action as an argument or retieves it from the request object
	 * properly formats action for the framework
	 * checkts to see if the action exists in the appropriate controller
	 * 
	 * @param string $action
	 * @return  $this|Exception 
	 * @throws Exception If action doesn't exist on the controller - routes to errorController
	 */
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
		Throw new \Exception('notFound');
	}

	/**
	 * takes parameters as an argument or retrieves from the request object
	 * 
	 * @param array $parameters
	 * @return  void 
	 */
	public function setParameters($parameters = null)
	{
		if ($parameters === null) {
			$this->parameters = $this->request->getParameters();
		} else {
			$this->parameters = $parameters;
		}
	}

	/**
	 * executes setController() , setAction(), setParameters() preparing the dispatcher
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->setController();
		$this->setAction();
		$this->setParameters();
	}

	/**
	 * creates a new controller and executes the action using the specified parameters
	 * 
	 * @return void
	 */
	public function dispatch()
	{
		call_user_func_array(array(new $this->controller($this->request, $this->connection), $this->action), $this->parameters);
	}


}

