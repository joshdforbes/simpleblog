<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;
use Simpleblog\Model\User as User;
use Simpleblog\Classes\Auth as Auth;

class AdminController extends BaseController 
{
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);

		$auth = new Auth($connection);
		if (!$auth->isAdmin()) {
			$this->response->addHeader('Location: /');
			$this->response->send();
		}	
	}

	public function indexAction()
	{
		$articles = Article::findAll($this->connection);
		
		$this->view->set('articles', $articles);
		$this->view->set('title', 'test page');
		$content = $this->view->render('adminArticles.php');
		$this->response->setContent($content);
		$this->response->send();
	}


	public function saveArticleAction()
	{
		$article = new Article($this->connection, $this->request->post());
		$article->save();

		$this->response->addHeader('Location: /admin');
		$this->response->send();
	}

	public function deleteArticleAction($id)
	{
		$article = Article::find($this->connection, $id);

		$article->delete();

		$this->response->addHeader('Location: /admin');
		$this->response->send();
	}

	public function editArticleAction($id)
	{
		$article = Article::find($this->connection, $id);
		
		$this->view->set('article', $article);
		$this->view->set('title', 'Edit Article');
		$content = $this->view->render('adminEditArticle.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	public function usersAction()
	{
		$users = User::findAll($this->connection);
		
		$this->view->set('users', $users);
		$this->view->set('title', 'Users');
		$content = $this->view->render('adminUsers.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	public function saveUserAction()
	{
		$user = new User($this->connection, $this->request->post());
		$user->save();

		$this->response->addHeader('Location: /admin/users');
		$this->response->send();
	}

	public function deleteUserAction($id)
	{
		$user = User::find($this->connection, $id);

		$user->delete();

		$this->response->addHeader('Location: /admin/users');
		$this->response->send();
	}

	public function editUserAction($id)
	{
		$user = User::find($this->connection, $id);
		
		$this->view->set('user', $user);
		$this->view->set('title', 'Edit User');
		$content = $this->view->render('adminEditUser.php');
		$this->response->setContent($content);
		$this->response->send();
	}
}