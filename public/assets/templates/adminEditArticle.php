	
<h1><?php echo $this->data['article']->title; ?></h1>
<h5><?php echo $this->data['article']->date; ?></h5>
<p><?php echo $this->data['article']->content; ?></p>

<form action="/admin/saveArticle" method="post">
Title: <input type="text" name="title" value="<?= $this->data['article']->title; ?>"><br>
Content: <input type="text" name="content" value="<?= $this->data['article']->content; ?>"><br>
Content Preview: <input type="text" name="content_preview" value="<?= $this->data['article']->contentPreview; ?>"><br>
<input type="hidden" name="id" value="<?= $this->data['article']->id; ?>">

<input type="submit">
</form>

