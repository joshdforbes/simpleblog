<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\User as User;
use Simpleblog\Classes\Auth;
use Simpleblog\Classes\Logger;


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

		if ($loggedIn && $user->getPrivledge() === 'admin') {
			$this->response->addHeader('Location: /admin');
			$this->response->send();
		} elseif ($loggedIn) {
			$this->response->addHeader('Location: /');
			$this->response->send();
		} else {
			$this->response->setContent($loginError = 'Invalid Username or Password');
			$this->response->setContent($this->indexAction());
			$this->response->send();
		}
	}

}