<?php

namespace Simpleblog\Controller;
use Simpleblog\View\View as View;

abstract class BaseController
{
	/**
	 * Request object
	 * 
	 * @var Request
	 */
	protected $request;

	/**
	 * database connection
	 * 
	 * @var PDO
	 */
	protected $connection;

	/**
	 * a View object, created by the BaseController
	 * 
	 * @var View
	 */
	protected $view;

	/**
	 * a Response object, created by the BaseController
	 * 
	 * @var Response
	 */
	protected $response;

	/**
	 * construct. Injected with Request and PDO object. Created new View and Response object
	 * 
	 * @param Request $request    
	 * @param PDO     $connection 
	 */
	public function __construct(Request $request, \PDO $connection)
	{
		$this->request = $request;
		$this->connection = $connection;
		$this->view = new View;
		$this->response = new Response;
	}
}