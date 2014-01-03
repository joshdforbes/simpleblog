<?php

include 'config.php';
require 'vendor/autoload.php';

$connection = Simpleblog\Database\DatabaseConnection::getConnection($config);

$testArray = array(
    'id' => 2,
    'author_id' => 1,
    'date' => date('Ymd'),
    'title' => 'Updated',
    'content' => 'Again all the thing'
);

$newPost = new Simpleblog\Model\Article($connection, $testArray);

$articles = Simpleblog\Model\Article::findAll($connection, 'date DESC', 0, 100);

foreach ($articles as $article) {
    echo $article->content."</br>";
    echo $article->id."</br></br>";

    if ($article->id = 10) {
    	$article->delete();
    }
}




