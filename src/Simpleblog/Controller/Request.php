<?php
namespace Simpleblog\Controller;

class Request
{
	/**
	 * request URI
	 * 
	 * @var string
	 */
	private $uri;

	/**
	 * request method, likely either 'get' or 'post'
	 *
	 * @var string
	 */
	private $method;

	/**
	 * the $_GET array
	 * 
	 * @var array
	 */
	private $get = array();

	/**
	 * the $_POST array
	 * 
	 * @var array
	 */
	private $post = array();

	/**
	 * the $_COOKIE array
	 * 
	 * @var array
	 */
	private $cookie = array();

	/**
	 * the controller
	 * 
	 * @var string
	 */
	private $controller;

	/**
	 * the action
	 * 
	 * @var string
	 */
	private $action;

	/**
	 * the parameters
	 * 
	 * @var array
	 */
	private $parameters;

	/** 
	 * contructor - sets $uri and $method based on server variables
	 * sets $get, $post, and $cookie based on global arrays
	 */
	public function __construct()
	{
		$this->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$this->method = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'get';

		$this->get = $_GET;
		$this->post = $_POST;
		$this->cookie = $_COOKIE;
	}

	/**
	 * get the uri
	 * 
	 * @return string
	 */
	public function getUri()
	{
		return $this->uri;
	}

	/**
	 * get the controller
	 * 
	 * @return string
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * set the controller
	 * 
	 * @param string $controller
	 * @return Request returns Request instance for method chaining
	 */
	public function setController($controller)
	{
		$this->controller = $controller;
		return $this;
	}

	/**
	 * get the action
	 * 
	 * @return string
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * set the action
	 * 
	 * @param string $action
	 * @return Request returns Request instance for method chaining 
	 */
	public function setAction($action)
	{
		$this->action = $action;
		return $this;
	}

	/**
	 * get the parameters
	 * 
	 * @return array
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * set the parameters
	 * 
	 * @param array $parameters
	 * @return  Request returns the Request instance for method chaining
	 */
	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
		return $this;
	}

	/**
	 * access values from the get array, based on supplied name
	 * 
	 * @param  string $name 
	 * @param  string $default 
	 * @return string returns the value associated with the $name or $default if not found
	 */
	public function get($name, $default = null)
	{
		return isset($this->get[$name]) ? $this->get[$name] : $default;
	}

	/**
	 * access the post array
	 *
	 * if a name is supplied search for it and return the value if found or the default 
	 * value if not found. If no name is supplied return entire post array
	 * 
	 * @param  string $name
	 * @param  string $default
	 * @return string|array 
	 */
	public function post($name = null, $default = null)
	{
		if (isset($name)) {
			return isset($this->post[$name]) ? $this->post[$name] : $default;
		} else {
			return $this->post;
		}		
	}

	/**
	 * access values from the cookie array, based on supplied name
	 * 
	 * @param  string $name 
	 * @param  string $default 
	 * @return string returns the value associated with the $name or $default if not found
	 */
	public function cookie($name, $default = null)
	{
		return isset($this->cookie[$name]) ? $this->cookie[$name] : $default;
	}

	/**
	 * get the method
	 * 
	 * @return string
	 */
	public function getMethod()
	{
		return $this->method;
	}
}