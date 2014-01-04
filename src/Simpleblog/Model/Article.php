<?php
namespace Simpleblog\Model;
use Simpleblog\Classes\Logger;

class Article extends Model
{
	protected static $table = 'articles';
	//public $id;
	public $author_id;
	public $date;
	public $title;
	public $content;

	public function __construct(\PDO $connection, array $data)
	{
		parent::__construct($connection, $data);

		//if (isset($data['id'])) {
		//	$this->id = $data['id'];
		//}
		$this->author_id = (int) $data['author_id'];
		$this->title = $data['title'];
		$this->content = $data['content'];
		$this->date = $data['date'];
	}

	public function insert()
	{
		try {
			$query = $this->connection->prepare("INSERT INTO ".self::$table."(author_id, date, title, content) VALUES (:author_id, :date, :title, :content)");
			$query->bindParam(':author_id', $this->author_id);
			$query->bindParam(':date', $this->date);
			$query->bindParam(':title', $this->title);
			$query->bindParam(':content', $this->content);
			$query->execute();

			$this->id = $this->connection->lastInsertId();

			return true;
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

	public function update()
	{
		try {
			$query = $this->connection->prepare("UPDATE ".self::$table." SET author_id=:author_id, date=:date, title=:title, content=:content WHERE id=:id");
			$query->bindParam(':id', $this->id);
			$query->bindParam(':author_id', $this->author_id);
			$query->bindParam(':date', $this->date);
			$query->bindParam(':title', $this->title);
			$query->bindParam(':content', $this->content);

			return $query->execute();
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

}