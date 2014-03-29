	
<h1><?php echo $this->data['user']->username; ?></h1>
<h5><?php echo $this->data['user']->email; ?></h5>

<form action="/admin/saveUser" method="post">
Username: <input type="text" name="username" value="<?= $this->data['user']->username; ?>"><br>
Password: <input type="password" name="password"><br>
Email: <input type="text" name="email" value="<?= $this->data['user']->email; ?>"><br>
Privledge: <input type="text" name="privledge" value="<?= $this->data['user']->privledge; ?>"><br>
<input type="hidden" name="id" value="<?= $this->data['user']->id; ?>">

<input type="submit">
</form>

