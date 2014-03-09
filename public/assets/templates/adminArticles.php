
<?php foreach($this->data['articles'] as $article): ?>
	<article>
	<h1><a href="/articles/article/<?= $article->id; ?>"> <?= $article->title; ?> </a></h1>
	
    <h5><?= $article->date; ?></h5>
    <p><?= $article->contentPreview; ?></p>
    <a href="/admin/deleteArticle/<?= $article->id; ?>">DELETE</a>
	</article>
<?php endforeach; ?>

<form action="/admin/insertArticle" method="post">
Title: <input type="text" name="title"><br>
Content: <input type="text" name="content"><br>
Content Preview: <input type="text" name="content_preview"><br>
<input type="submit">
</form>

