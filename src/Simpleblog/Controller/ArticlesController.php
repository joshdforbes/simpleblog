<?php

namespace Simpleblog\Controller;
use Simpleblog\Model\Article as Article;
//include 'config.php';

class PostsController
{
	private $connection;

	public function __construct($connection)
	{
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