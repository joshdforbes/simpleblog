<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;

class AdminController extends BaseController 
{
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);		
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


	public function insertArticleAction()
	{
		$article = new Article($this->connection, $_POST);
		$article->insert();

		$this->response->addHeader('Location: ../admin');
		$this->response->send();
	}

	public function deleteArticleAction($id)
	{
		$article = Article::find($this->connection, $id);

		$article->delete();

		$this->response->addHeader('Location: ../');
		$this->response->send();
	}
}