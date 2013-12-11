<?php 
include '../config.php';
include '../classes/Logger.class.php';
include '../classes/DatabaseConnection.class.php';
include '../model/Model.class.php';
include '../model/Article.class.php';

$connection = DatabaseConnection::getConnection($config);

$testArray = array(
    'id' => 30,
    'author_id' => 1,
    'date' => date('Ymd'),
    'title' => 'Another Post',
    'content' => 'Test'
);

$newPost = new Article($connection, $testArray);
$newPost->save();

$articles = Article::findAll($connection);

foreach ($articles as $article) {
    echo $article->content."</br>";
}