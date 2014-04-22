<?php
namespace Simpleblog\Controller;

class Router 
{
	/**
	 * @var Simpleblog\Controller\Request
	 */
	private $request;

	/**
	 * @var string
	 */
	private $defaultController = 'articles';

	/**
	 * @var string
	 */
	private $defaultAction = 'index';

	/**
	 * takes a request object and parses it
	 * @param Simpleblog\Controller\Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->parseRequest();
	}

	/**
	 * parses the request object
	 *
	 * cleans the uri of unnecessary characters. parses the controller, action and parameters
	 * to values obtained from the uri. Or if they don't exist , uses default values
	 * 
	 * @return void
	 */
	public function parseRequest()
	{
		$request = explode('/', trim($this->request->getUri(), '/'));
		$request = preg_replace('/[^0-9a-zA-Z]/', '', $request);
		$this->controller = !empty($request[0]) ? array_shift($request) : $this->defaultController;
		$this->action = !empty($request[0]) ? array_shift($request) : $this->defaultAction;
		$this->parameters = !empty($request[0]) ? $request : array();
	}

	/**
	 * sets the parsed controller, action, and parameters values on the Request object
	 * 
	 * @return void
	 */
	public function route()
	{
		$this->request->setController($this->controller)
			->setAction($this->action)
			->setParameters($this->parameters);
	}
}