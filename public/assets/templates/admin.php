<?php require("adminBar.php"); ?> 

<?php foreach($this->data['articles'] as $article): ?>
	<article>
	<h2><a href="/articles/article/<?= $article->id; ?>"> <?= $article->title; ?> </a></h2>
	
    <h5><?= $article->date; ?></h5>
    <p><?= $article->contentPreview; ?></p>
    <a href=href="/articles/article/<?= $article->id; ?>" class="read-more-link">Read the rest of this entry »</p>

    <a href="/admin/deleteArticle/<?= $article->id; ?>">DELETE</a>
    <a href="/admin/editArticle/<?= $article->id; ?>">EDIT</a>
	</article>
<?php endforeach; ?>

<form action="/admin/saveArticle" method="post">
Title: <input type="text" name="title"><br>
Content: <input type="text" name="content"><br>
Content Preview: <input type="text" name="content_preview"><br>
<input type="submit">
</form>

