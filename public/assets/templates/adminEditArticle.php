<div class="article-wrapper container">

<?php require("adminBar.php"); ?> 

<article>	
<h2><?php echo $this->data['article']->title; ?></h2>
<h5><?php echo $this->data['article']->date; ?></h5>
<p><?php echo $this->data['article']->content; ?></p>

<form action="/admin/saveArticle" method="post" class="form-create-article">
	<h2 class="form-heading">Edit Article</h2>
	<input type="text" class="form-control" name="title" value="<?= $this->data['article']->title; ?>" required autofocus>
	<textarea rows="15" class="form-control" name="content" required><?= $this->data['article']->content; ?></textarea>
	<textarea rows="10" class="form-control" name="content_preview" required><?= $this->data['article']->contentPreview; ?></textarea>
	<input type="hidden" name="id" value="<?= $this->data['article']->id; ?>">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
</form>
</article>

</div>

