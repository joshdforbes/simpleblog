<?php

namespace Simpleblog\Controller;
use Simpleblog\View\View as View;

abstract class BaseController
{
	protected $request;
	protected $connection;
	protected $view;
	protected $response;

	public function __construct(Request $request, \PDO $connection)
	{
		$this->request = $request;
		$this->connection = $connection;
		$this->view = new View;
		$this->response = new Response;
	}
}