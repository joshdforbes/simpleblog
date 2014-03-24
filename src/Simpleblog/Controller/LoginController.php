<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\User as User;


class LoginController extends BaseController
{
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);		
	}

	public function indexAction()
	{	
		$this->view->set('title', 'Login');
		$content = $this->view->render('login.php');
		$this->response->setContent($content);
		$this->response->send();
	}