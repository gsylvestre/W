<?php $this->layout('layout', ['title' => 'Créer un nouvel administrateur']) ?>

<?php $this->start('main_content'); ?>
<h1>Créer un nouvel administrateur</h1>

<form method="POST" action="<?= $this->url('addAdminHandler'); ?>">
	<div class="form-group">
		<label for="username">Pseudo</label>
		<input type="text" name="username" id="username" value="" class="form-control" />
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" value="" class="form-control" />
	</div>
	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password" value="" class="form-control" />
	</div>
	<div class="form-group">
		<label for="password_confirm">Mot de passe encore</label>
		<input type="password" name="password_confirm" id="password_confirm" value="" class="form-control" />
	</div>
	<div class="form-group">
		<input type="submit" value="Ajouter !" class="btn btn-primary" />
	</div>
	<?php if (!empty($errors)): ?>
	<ul class="text-danger">
		<?php foreach($errors as $error): ?>
			<li><?= $error; ?></li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</form>

<?php $this->stop('main_content'); ?>
