<?php
namespace Simpleblog\Controller;

class ErrorController extends BaseController
{
	private $parameters;

	/**
	 * calls BaseController constructor
	 * @param Request $request    
	 * @param PDO     $connection 
	 */
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);		
	}

	public function notFoundAction()
	{
		$this->view->set('error', 'Page Not Found');
		$this->view->set('title', 'Page Not Found');
		$content = $this->view->render('error.php');
		$this->response->setStatus(404);
		$this->response->setContent($content);
		$this->response->send();
	}

	public function databaseErrorAction()
	{
		$this->view->set('error', 'An internal error occured, please try your request again');
		$this->view->set('title', 'Internal Error');
		$content = $this->view->render('error.php');
		$this->response->setStatus(500);
		$this->response->setContent($content);
		$this->response->send();
	}
}