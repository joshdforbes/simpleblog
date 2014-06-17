<?php require("adminBar.php"); ?> 

<div class="container">
<table>
	<thead>
		<th>Username</th>
		<th>Email</th>
		<th>Privledge</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
	<?php foreach($this->data['users'] as $user): ?>
	<tr>
		<td><?= $user->username; ?></td>
		<td><?= $user->email; ?></td>
		<td><?= $user->getPrivledge(); ?></td>
		<div class="admin-buttons">
		<td><button class="btn btn-danger"><a href="/admin/deleteUser/<?= $user->id; ?>"><i class="fa fa-trash-o"></i><span class="button-text">DELETE</span></a></button></td>
		<td><button class="btn btn-primary"><a href="/admin/editUser/<?= $user->id; ?>"><i class="fa fa-cog"></i><span class="button-text">EDIT</span></a></button></td>
    	</div>
    </tr>
    <?php endforeach; ?>
	</tbody>
</table>


<form action="/admin/saveUser" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
Email: <input type="text" name="email"><br>
Privledge: <input type="text" name="privledge"><br>
<input type="submit">
</form>
</div>
