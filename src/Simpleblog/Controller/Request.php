<?php
namespace Simpleblog\Controller;

class Request
{
	private $uri;
	private $method;
	private $get = array();
	private $post = array();
	private $cookie = array();

	private $controller;
	private $action;
	private $parameters;

	public function __construct()
	{
		$this->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$this->method = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'get';

		$this->get = $_GET;
		$this->post = $_POST;
		$this->cookie = $_COOKIE;
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function getController()
	{
		return $this->controller;
	}

	public function setController($controller)
	{
		$this->controller = $controller;
		return $this;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function setAction($action)
	{
		$this->action = $action;
		return $this;
	}

	public function getParameters()
	{
		return $this->parameters;
	}

	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
		return $this;
	}

	public function get($name, $default = null)
	{
		return isset($this->get[$name]) ? $this->get[$name] : $default;
	}

	public function post($name, $default = null)
	{
		return isset($this->post[$name]) ? $this->post[$name] : $default;
	}

	public function cookie($name, $default = null)
	{
		return isset($this->cookie[$name]) ? $this->cookie[$name] : $default;
	}

	public function getMethod()
	{
		return $this->method;
	}
}