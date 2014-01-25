<?php 
include '../bootstrap.php';

$request = new \Simpleblog\Controller\Request();
$router = new \Simpleblog\Controller\Router($request);
?>

<form action="/posts/create" method="post">
type something:<input type="text" name="name"></input>
<input type="submit" value="submit">
</form>