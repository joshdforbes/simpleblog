<?php
namespace Simpleblog\Controller;

class Router 
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->parseRequest();
	}

	public function parseRequest()
	{
		$request = explode('/', trim($this->request->getUri(), '/'));
		$request = preg_replace('/[^0-9a-zA-Z]/', '', $request);
		$this->controller = !empty($request[0]) ? array_shift($request) : 'posts';
		$this->action = isset($request[0]) ? array_shift($request) : 'index';
		$this->parameters = isset($request[0]) ? $request : array();
	}

	public function route()
	{
		$this->request->setController($this->controller)
			->setAction($this->action)
			->setParameters($this->parameters);
	}
}