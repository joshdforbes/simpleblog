<html>
<head>
	<title>
		Test Article View
	</title>
</head>
<body>
	
<?php foreach($this->data as $article): ?>
	<h1><?php echo $article->title; ?></h1>
    <h5><?php echo $article->date; ?></h5>
    <p><?php echo $article->content; ?></p>
<?php endforeach; ?>


</body>
</html>
