<div class="article-wrapper container">

<?php require("adminBar.php"); ?> 

<a href="/admin/createArticle/"><button class="create-article-button btn">
	<h5>Create Article</h5>
</button></a>

<?php foreach($this->data['articles'] as $article): ?>
	<article>
	<h2><a href="/articles/article/<?= $article->id; ?>"> <?= $article->title; ?> </a></h2>
	<h5><?= $article->date; ?></h5>

	<div class="admin-buttons">
    <a href="/admin/editArticle/<?= $article->id; ?>"><button class="btn btn-primary">EDIT</button></a>
	<a href="/admin/deleteArticle/<?= $article->id; ?>"><button class="btn btn-danger">DELETE</button></a>
	</div>

    <p><?= $article->contentPreview; ?></p>
    <a href="/articles/article/<?= $article->id; ?>" class="read-more-link">Read the rest of this entry »</a>

	</article>
<?php endforeach; ?>

</div>


