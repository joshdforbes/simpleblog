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
		
		$view = new View('article.php');
		$view->set('article', $article);
		$view->set('title', 'test2');
		$response = new Response;
		$response->setContent($view->render());
		$response->send();
	}

}