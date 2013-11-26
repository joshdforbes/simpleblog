<?php

class Article 
{
	private $connection;
	private $table = 'articles';
	private $id;
	private $author_id;
	private $date;
	private $title;
	private $content;

	public function __connect(PDO $connection, array $data, $table = 'articles')
	{
		$this->connection = $connection;
		$this->table = $table;
		$this->id = isset($data['id']) 
			? $data['id']
			: null;

		$this->author_id = $data['author_id'];
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
				? $result->fetchAll(PDO::FETCH_ASSOC)
				: false;
		} catch (PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}


}