<div class="article-wrapper container">

<?php require("adminBar.php"); ?> 

<article>	
<h2><?php echo $this->data['article']->title; ?></h2>
<h5><?php echo $this->data['article']->date; ?></h5>
<p><?php echo $this->data['article']->content; ?></p>

<form action="/admin/saveArticle" method="post" class="form-edit-article">
	<h2 class="form-heading">Edit Article</h2>
	<label for="title">Title</label>
	<input type="text" class="form-control" name="title" id="title" value="<?= $this->data['article']->title; ?>" required autofocus>
	<label for="content">Content</label>
	<textarea rows="20" class="form-control" name="content" id="content" required><?= $this->data['article']->content; ?></textarea>
	<label for="content_preview">Content Preview</label>
	<textarea rows="10" class="form-control" name="content_preview" id="content_preview" required><?= $this->data['article']->contentPreview; ?></textarea>
	<input type="hidden" name="id" value="<?= $this->data['article']->id; ?>">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
</form>
</article>

</div>

