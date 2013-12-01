<?php

class Article 
{
	private $connection;
	public $id;
	public $author_id;
	public $date;
	public $title;
	public $content;

	public function __construct(PDO $connection, array $data, $table = 'articles')
	{
		$this->connection = $connection;
		$this->id = isset($data['id']) 
			? (int) $data['id']
			: null;

		$this->author_id = (int) $data['author_id'];
		$this->title = $data['title'];
		$this->content = $data['content'];
		$this->date = $data['date'];
	}

	public static function getById(PDO $connection, $id)
	{
		try {
			$query = $connection->prepare("SELECT * from articles WHERE id = :id LIMIT 1");
			$query->bindParam(':id', $id);
			$query->execute();

			return ($query->rowCount() === 1)
				? new Article($connection, $query->fetch(PDO::FETCH_ASSOC))
				: false;
		} catch (PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

	public static function getAll(PDO $connection, $orderBy = "date DESC", $startingArticle = 0, $endingArticle = 5)
	{
		try {
			$query = $connection->prepare("SELECT * FROM articles ORDER BY :orderBy LIMIT :startingArticle, :endingArticle");
			$query->bindParam(':orderBy', $orderBy);
			$query->bindParam(':startingArticle', $startingArticle, PDO::PARAM_INT);
			$query->bindParam(':endingArticle', $endingArticle, PDO::PARAM_INT);
			$query->execute();

			while ($result = $query->fetch(PDO::FETCH_ASSOC) ) {
      			$article = new Article($connection, $result);
      			$articles[] = $article;
    		}

    		return (count($articles) > 1)
    			? $articles
    			: false;
		} catch (PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

	public function insert()
	{
		try {
			$query = $this->connection->prepare("INSERT INTO articles(author_id, date, title, content) VALUES (:author_id, :date, :title, :content)");
			$query->bindParam('author_id', $this->author_id);
			$query->bindParam('date', $this->date);
			$query->bindParam(':title', $this->title);
			$query->bindParam(':content', $this->content);

			$this->id=$this->connection->lastInsertId();

			return $query->execute();
		} catch (PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

}