<div class="articles">

<?php foreach($this->data['articles'] as $article): ?>
	<article>
		<h2><a href="articles/article/<?= $article->id; ?>"> <?= $article->title; ?> </a></h2>
	
    	<h5><?= $article->date; ?></h5>
    	<p><?= $article->contentPreview; ?></p>
    </article>
<?php endforeach; ?>

</div>


