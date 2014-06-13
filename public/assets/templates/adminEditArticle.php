<?php require("adminBar.php"); ?> 

<article>	
<h2><?php echo $this->data['article']->title; ?></h2>
<h5><?php echo $this->data['article']->date; ?></h5>
<p><?php echo $this->data['article']->content; ?></p>
</article>

<form action="/admin/saveArticle" method="post">
Title: <input type="text" name="title" value="<?= $this->data['article']->title; ?>"><br>
Content: <textarea name="content" rows="10" cols="80"><?= $this->data['article']->content; ?></textarea><br>
Content Preview: <textarea name="content_preview" rows="10" cols="80"><?= $this->data['article']->contentPreview; ?></textarea><br>
<input type="hidden" name="id" value="<?= $this->data['article']->id; ?>">

<input type="submit">
</form>

