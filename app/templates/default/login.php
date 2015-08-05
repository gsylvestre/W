<?php $this->layout('layout', ['title' => 'Test avec id!']) ?>

<?php $this->start('main_content'); ?>

<h2>Connexion</h2>
<form method="POST" action="<?= $this->url('login'); ?>">
	<div class="form-group">
		<label for="username">Pseudo ou email</label>
		<input type="text" name="username" id="username" value="" class="form-control" />
	</div>
	<div class="form-group">
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password" value="" class="form-control" />
	</div>
	<div class="form-group">
		<input type="submit" value="Ajouter !" class="btn btn-primary" />
	</div>
	<?php if (!empty($error)): ?>
	<ul class="text-danger">
		<li><?= $error; ?></li>
	</ul>
	<?php endif; ?>
</form>

<?php $this->stop('main_content'); ?>
