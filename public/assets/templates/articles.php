<html>
<head>
	<title>
		<?php echo $this->data['title']; ?>
	</title>
</head>
<body>
	
<?php foreach($this->data['articles'] as $article): ?>
	<h1><a href="articles/article/<?= $article->id; ?>"> <?= $article->title; ?> </a></h1>
	
    <h5><?= $article->date; ?></h5>
    <p><?= $article->content; ?></p>
<?php endforeach; ?>


</body>
</html>
