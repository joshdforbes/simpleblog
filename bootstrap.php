<?php

include 'config.php';
require 'vendor/autoload.php';

$connection = Simpleblog\Database\DatabaseConnection::getConnection($config);

$testArray = array(
    'id' => 2,
    'author_id' => 1,
    'date' => date('Ymd'),
    'title' => 'Updated',
    'content' => 'Again all the things'
);

$newPost = new Simpleblog\Model\Article($connection, $testArray);
$newPost->save();

$articles = Simpleblog\Model\Article::findAll($connection, 'date DESC', 0, 100);

foreach ($articles as $article) {
    echo $article->content."</br>";
}




