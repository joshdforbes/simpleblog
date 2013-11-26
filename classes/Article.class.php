<?php

class Article 
{
	private $connection;
	private $table = 'articles';
	public $id;
	public $author_id;
	public $date;
	public $title;
	public $content;

	public function __construct(PDO $connection, array $data, $table = 'articles')
	{
		$this->connection = $connection;
		$this->table = $table;
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
			$result = $connection->prepare("SELECT * from articles WHERE id = :id LIMIT 1");
			$result->bindParam(':id', $id);
			$result->execute();

			return ($result->rowCount() === 1)
				? new Article($connection, $result->fetch(PDO::FETCH_ASSOC))
				: false;
		} catch (PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}


}