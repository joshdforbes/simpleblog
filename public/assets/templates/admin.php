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
    <button class="btn btn-primary"><a href="/admin/editArticle/<?= $article->id; ?>">EDIT</a></button>
	<button class="btn btn-danger"><a href="/admin/deleteArticle/<?= $article->id; ?>">DELETE</a></button>
	</div>

    <p><?= $article->contentPreview; ?></p>
    <a href="/articles/article/<?= $article->id; ?>" class="read-more-link">Read the rest of this entry »</a>

	</article>
<?php endforeach; ?>

</div>


