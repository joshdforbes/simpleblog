<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;
use Simpleblog\View\View as View;


class ArticlesController
{
	private $request;
	private $connection;

	public function __construct(Request $request, \PDO $connection)
	{
		$this->request = $request;
		$this->connection = $connection;
	}

	public function indexAction()
	{
		$articles = Article::findAll($this->connection);
		
		$view = new View('articles.php');
		$view->set('articles', $articles);
		$view->set('title', 'test page');
		$response = new Response;
		$response->setContent($view->render());
		$response->send();
	}

	public function articleAction($id)
	{
		$article = Article::find($this->connection, $id);
		
		$view = new View('article.php');
		$view->set('article', $article);
		$view->set('title', 'test2');
		$response = new Response;
		$response->setContent($view->render());
		$response->send();
	}

}