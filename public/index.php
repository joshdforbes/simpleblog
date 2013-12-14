<?php 
include '../bootstrap.php';

$connection = \Simpleblog\Database\DatabaseConnection::getConnection($config);

$testArray = array(
    'author_id' => 1,
    'date' => date('Ymd'),
    'title' => 'Another Post',
    'content' => 'Test'
);

$newPost = new \Simpleblog\Model\Article($connection, $testArray);
$newPost->save();

$articles = \Simpleblog\Model\Article::findAll($connection);

foreach ($articles as $article) {
    echo $article->content."</br>";
}