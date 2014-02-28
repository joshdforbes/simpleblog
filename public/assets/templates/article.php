<html>
<head>
	<title>
		<?php echo $this->data['title']; ?>
	</title>
</head>
<body>
	
<h1><?php echo $this->data['article']->title; ?></h1>
<h5><?php echo $this->data['article']->date; ?></h5>
<p><?php echo $this->data['article']->content; ?></p>


</body>
</html>