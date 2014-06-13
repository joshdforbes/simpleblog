<?php require("adminBar.php"); ?> 

<form action="/admin/saveArticle" method="post">
Title: <input type="text" name="title"><br>
Content: <textarea name="content" rows="10" cols="80"><br>
Content Preview: <textarea name="content_preview" rows="10" cols="80"></textarea><br>
<input type="submit">
</form>


