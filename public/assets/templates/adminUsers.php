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
		<td class="button-cell"><button class="btn btn-primary"><a href="/admin/editUser/<?= $user->id; ?>"><i class="fa fa-cog"></i><span class="button-text">EDIT</span></a></button></td>
    	<td class="button-cell"><button class="btn btn-danger"><a href="/admin/deleteUser/<?= $user->id; ?>"><i class="fa fa-trash-o"></i><span class="button-text">DELETE</span></a></button></td>

    </tr>
    <?php endforeach; ?>
	</tbody>
</table>


<form action="/admin/saveUser" method="post" class="form-create-user">
	<h2 class="form-heading">Create New User</h2>
	<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
	<input type="password" class="form-control" name="password" placeholder="Password" required>
	<input type="email" class="form-control" name="email" placeholder="Email" required>
	<input type="text" class="form-control" name="privledge" placeholder="Privledge" required>	
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
</div>