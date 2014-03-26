<?php foreach($this->data['users'] as $user): ?>
	<article>
	<h1><a href="/users/user/<?= $user->id; ?>"> <?= $user->username; ?> </a></h1>
	
    <p><?= $user->email; ?></p>
    <a href="/admin/deleteUser/<?= $user->id; ?>">DELETE</a>
    <a href="/admin/editUser/<?= $user->id; ?>">EDIT</a>
	</article>
<?php endforeach; ?>

<form action="/admin/saveUser" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
Email: <input type="text" name="email"><br>
Privledge: <input type="text" name="privledge"><br>
<input type="submit">
</form>

