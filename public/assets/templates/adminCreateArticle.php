<div class="article-wrapper container">

<?php require("adminBar.php"); ?> 
<article>

<form action="/admin/saveArticle" method="post" class="form-create-article">
	<h2 class="form-heading">Create Article</h2>
	<input type="text" class="form-control" name="title" placeholder="Title" required autofocus>
	<textarea rows="15" class="form-control" name="content" placeholder="Content" required></textarea>
	<textarea rows="10" class="form-control" name="content_preview" placeholder="Content Preview" required></textarea>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
</form>

</article>
</div>

