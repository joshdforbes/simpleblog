<?php 
include '../config.php';
include '../classes/Logger.class.php';
include '../classes/DatabaseConnection.class.php';
include '../model/Model.class.php';
include '../model/Article.class.php';

$connection = DatabaseConnection::getConnection($config);

$testArray = array(
    'author_id' => 1,
    'date' => date('Ymd'),
    'title' => 'Another Post',
    'content' => 'New Post - Another!'
);

$newPost = new Article($connection, $testArray);
$newPost->insert();

$articles = Article::findAll($connection);

foreach ($articles as $article) {
    echo $article->content."</br>";
}