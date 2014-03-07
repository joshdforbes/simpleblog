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
		print_r($_POST);

		$article = new Article($this->connection, $_POST);
		$article->insert();

		$this->indexAction();
	}
}