<?php
namespace Simpleblog\Model;
use Simpleblog\Classes\Logger;

class Article extends Model
{
	protected static $table = 'articles';
	public $title;
	public $content;
	public $contentPreview;
	public $date;

	public function __construct(\PDO $connection, array $data)
	{
		parent::__construct($connection, $data);

		$this->title = $data['title'];
		$this->content = $data['content'];
		$this->contentPreview = $data['content_preview'];
		$this->date = $data['date'];
	}

	public function insert()
	{
		try {
			$query = $this->connection->prepare("INSERT INTO ".self::$table."(title, content, content_preview) VALUES (:title, :content, :contentPreview)");
			$query->bindParam(':title', $this->title);
			$query->bindParam(':content', $this->content);
			$query->bindParam(':contentPreview', $this->contentPreview);
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
			$query = $this->connection->prepare("UPDATE ".self::$table." SET title=:title, content=:content, content_preview=:contentPreview WHERE id=:id");
			$query->bindParam(':title', $this->title);
			$query->bindParam(':content', $this->content);
			$query->bindParam(':contentPreview', $this->contentPreview);
			$query->bindParam(':id', $this->id);

			return $query->execute();
		} catch (\PDOException $e) {
			Logger::log($e->getMessage());
			return false;
		}
	}

}