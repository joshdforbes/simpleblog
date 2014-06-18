<?php require("adminBar.php"); ?> 

<form action="/admin/saveUser" method="post" class="form-edit-user">
	<h2 class="form-heading">Edit User</h2>
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" id="username" value="<?= $this->data['user']->username; ?>" required autofocus>
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
	<label for="email">Email</label>
	<input type="email" class="form-control" name="email" id="email" value="<?= $this->data['user']->email; ?>" required>
	<label for="privledge">Privledge</label>
	<input type="text" class="form-control" name="privledge" id="privledge" value="<?= $this->data['user']->privledge; ?>" required>
	<input type="hidden" name="id" value="<?= $this->data['user']->id; ?>">	
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
</form>
</div>

