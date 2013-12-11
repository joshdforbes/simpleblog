<?php

class Article extends Model
{
	protected static $table = 'articles';
	public $author_id;
	public $date;
	public $title;
	public $content;

	public function __construct(PDO $connection, array $data)
	{
		parent::__construct($connection, $data);

		$this->author_id = (int) $data['author_id'];
		$this->title = $data['title'];
		$this->content = $data['content'];
		$this->date = $data['date'];
	}

	public function save()
	{
		if (!is_null($this->id)) {
			return $this->update();
		}

		try {
			$query = $this->connection->prepare("INSERT INTO ".self::$table."(author_id, date, title, content) VALUES (:author_id, :date, :title, :content)");
			$query->bindParam(':author_id', $this->author_id);
			$query->bindParam(':date', $this->date);
			$query->bindParam(':title', $this->title);
			$query->bindParam(':content', $this->content);
			$query->execute();

			$this->id = $this->connection->lastInsertId();

			return true;
		} catch (PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

	public function update()
	{
		echo "updating";
	}

	public function delete()
	{

	}

}