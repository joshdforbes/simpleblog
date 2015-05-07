<?php

namespace Simpleblog\Controller;
use Simpleblog\Classes\Logger;
use Simpleblog\Model\User as User;
use Simpleblog\Classes\Auth as Auth;

class LoginController extends BaseController
{

	/**
	 * calls BaseController constructor
	 *
	 * @param Request $request
	 * @param \PDO|PDO $connection
	 */
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);	
	}

	/**
	 * The default action - displays the login form
	 * 
	 * @return void
	 */
	public function indexAction()
	{	
		$this->view->set('title', 'Login');
		$content = $this->view->render('login.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	/**
	 * attempts to log the user in
	 *
	 * attempts to find the user based on the username in the request object.
	 * if the user is not found, reload the login page with an error message
	 * if the user is found, attempt to verify the password using password_verify
	 * if the passwords match - log the user in and redirect to the root
	 * if the passwords do not match, reload the login page with an error message
	 * 
	 * @return void
	 */
	public function loginAction()
	{
		Logger::log(password_hash($this->request->post('password'), PASSWORD_BCRYPT));

		$user = User::findByUsername($this->connection, $this->request->post('username'));
		if (!$user) {
			$this->view->set('loginError', 'Invalid Username or Password');
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
			$this->view->set('loginError', 'Invalid Username or Password');
			//$this->response->setContent($loginError = 'Invalid Username or Password');
			$this->response->setContent($this->indexAction());
			$this->response->send();
		}
	}

}