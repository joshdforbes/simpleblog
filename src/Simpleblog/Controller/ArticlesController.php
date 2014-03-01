<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;


class ArticlesController extends BaseController
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
		$content = $this->view->render('articles.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	public function articleAction($id)
	{
		$article = Article::find($this->connection, $id);
		
		$this->view->set('article', $article);
		$this->view->set('title', 'test 2');
		$content = $this->view->render('article.php');
		$this->response->setContent($content);
		$this->response->send();
	}

}