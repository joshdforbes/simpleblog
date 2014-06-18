<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;


class ArticlesController extends BaseController
{
	/**
	 * calls BaseController constructor
	 * @param Request $request    
	 * @param PDO     $connection 
	 */
	public function __construct(Request $request, \PDO $connection)
	{
		parent::__construct($request, $connection);		
	}

	/**
	 * The default action - finds all Articles, sets the Article data 
	 * on the view object, and renders the appropriate template
	 * 
	 * @return void
	 */
	public function indexAction()
	{
		$articles = Article::findAll($this->connection);
		
		$this->view->set('articles', $articles);
		$this->view->set('title', 'Simpleblog');
		$content = $this->view->render('articles.php');
		$this->response->setContent($content);
		$this->response->send();
	}

	/**
	 * finds a Article based on the supplied id, sets that Article data on the view object, 
	 * and renders the appropriate template
	 * 
	 * @param  string $id
	 * @return void
	 * @throws Exception If article is not found route to ErrorController
	 */
	public function articleAction($id)
	{
		$article = Article::find($this->connection, $id);

		if ($article) {
			$this->view->set('article', $article);
			$this->view->set('title', $article->title);
			$content = $this->view->render('article.php');
			$this->response->setContent($content);
			$this->response->send();
		}
		else {
			Throw new \Exception('notFound');
		}
		
	}

}