<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\User as User;
use Simpleblog\Classes\Auth as Auth;

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

	public function loginAction()
	{
		$user = User::findByUsername($this->connection, $this->request->post('username'));
		if (!$user) {
			$this->response->setContent($loginError = 'Invalid Username or Password');
			$this->response->setContent($this->indexAction());
			$this->response->send();
		}

		$loggedIn = password_verify($this->request->post('password'), $user->getHashedPassword());

		if ($loggedIn) {
			session_start();
			$_SESSION['username'] = $user->username;
			$this->response->addHeader('Location: /');
			$this->response->send();
		} else {
			$this->response->setContent($loginError = 'Invalid Username or Password');
			$this->response->setContent($this->indexAction());
			$this->response->send();
		}
	}

	public function logoutAction(){
    	$_SESSION = array();
    	session_destroy();
	}

}