<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;


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
		print_r($articles);
	}

	public function articleAction($id)
	{
		$article = Article::find($this->connection, $id);
		print_r($article);

	}

}