
<?php if(isset($this->data['loginError'])): ?>
	<div class="alert alert-warning text-center">
		<strong><?= $this->data['loginError']; ?></strong>
	</div> 
<? endif; ?>

<form action="/login/login" method="post" class="form-signin">
	<h2 class="form-signin-heading">Please sign in</h2>
	<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
	<input type="password" class="form-control" name="password" placeholder="Password" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>


