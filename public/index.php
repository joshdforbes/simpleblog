<?php 
include '../bootstrap.php';

$router = new \Simpleblog\Controller\FrontController($_SERVER['REQUEST_URI']);
?>

<form action="/posts/create" method="post">
type something:<input type="text" name="name"></input>
<input type="submit" value="submit">
</form>