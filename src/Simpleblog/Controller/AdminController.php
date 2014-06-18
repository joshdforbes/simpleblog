<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;
use Simpleblog\Model\User as User;
use Simpleblog\Classes\Auth as Auth;

class AdminController extends BaseController 
{
	/**
	 * calls BaseControllers constructor
	 * creates a new Auth object and verifies that the user is an admin (this is a password protected page)
	 * if the user is not an admin, redirects to the root
	 * 
	 * @param Request $request    
	 * @param PDO     $connection
	 * @return  void 
	 * 
	 */
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);

		$auth = new Auth($connection);
		if (!$auth->isAdmin()) {
			$this->response->addHeader('Location: /');
			$this->response->send();
		}

	}

	/**
	 * default action - acts as admin dashboard
	 * 
	 * @return void
	 */
	public function indexAction()
	{
		$articles = Article::findAll($this->connection);
		
		$this->view->set('articles', $articles);
		$this->view->set('title', 'Admin Dashboard');
		$content = $this->view->render('admin.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	/**
	 * finds all Articles, set the Articles data on the view object, and renders the appropriate template
	 * 
	 * @return void
	 */
	public function articlesAction()
	{
		$articles = Article::findAll($this->connection);
		
		$this->view->set('articles', $articles);
		$this->view->set('title', 'Articles');
		$content = $this->view->render('adminArticles.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	/**
	 * creates an Article object based on data supplied by the request object
	 * calls the save method on the Article object which either updates or creates the item in the database
	 * reloads the admin page
	 * 
	 * @return void
	 */
	public function saveArticleAction()
	{
		$article = new Article($this->connection, $this->request->post());
		$article->save();

		$this->response->addHeader('Location: /admin');
		$this->response->send();
	}

	/**
	 * finds an article based on the supplied id and deletes it from the database
	 * reloads the admin page
	 * 
	 * @param  string $id
	 * @return void
	 */
	public function deleteArticleAction($id)
	{
		$article = Article::find($this->connection, $id);

		$article->delete();

		$this->response->addHeader('Location: /admin');
		$this->response->send();
	}

	/**
	 * renders the form for article creation
	 * 
	 * @return void
	 */
	public function createArticleAction()
	{		
		$this->view->set('title', 'Create Article');
		$content = $this->view->render('adminCreateArticle.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	/**
	 * finds an article based on the supplied id, sets that articles data on the view object, 
	 * and renders the appropriate template
	 * 
	 * @param  string $id
	 * @return void
	 */
	public function editArticleAction($id)
	{
		$article = Article::find($this->connection, $id);
		
		$this->view->set('article', $article);
		$this->view->set('title', 'Edit Article');
		$content = $this->view->render('adminEditArticle.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	/**
	 * finds all users, sets the user data on the view object, and renders the appropriate template
	 * 
	 * @return void
	 */
	public function usersAction()
	{
		$users = User::findAll($this->connection, 'username asc');
		
		$this->view->set('users', $users);
		$this->view->set('title', 'Users');
		$content = $this->view->render('adminUsers.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	/**
	 * creates an User object based on data supplied by the request object
	 * calls the save method on the User object which either updates or creates the User in the database
	 * reloads the admin/users page
	 * 
	 * @return void
	 */
	public function saveUserAction()
	{
		$user = new User($this->connection, $this->request->post());
		$user->save();

		$this->response->addHeader('Location: /admin/users');
		$this->response->send();
	}

	/**
	 * finds a User based on the supplied id and deletes it from the database
	 * reloads the admin/users page
	 * 
	 * @param  string $id
	 * @return void
	 */
	public function deleteUserAction($id)
	{
		$user = User::find($this->connection, $id);

		$user->delete();

		$this->response->addHeader('Location: /admin/users');
		$this->response->send();
	}

	/**
	 * finds a User based on the supplied id, sets that Users data on the view object, 
	 * and renders the appropriate template
	 * 
	 * @param  string $id
	 * @return void
	 */
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