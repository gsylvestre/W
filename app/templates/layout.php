<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?=$this->e($title);?></title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=$this->assetUrl('css/style.css'); ?>">
</head>
<body>
	<div class="container">
		<header>
			<h1>W Blog :: <?=$this->e($title);?></h1>
			<nav>
				<ul class="nav nav-pills">
					<li><a href="<?= $this->url('home') ?>" title="">Accueil</a></li>
					<li><a href="<?= $this->url('adminHome') ?>" title="">Admin</a></li>
					<li><a href="<?= $this->url('addAdmin') ?>" title="">Ajouter un administrateur</a></li>
					<?php if ($w_user): ?>
					<li><a href="<?= $this->url('logout') ?>" title="">Déconnexion</a></li>
					<?php else: ?>
					<li><a href="<?= $this->url('login') ?>" title="">Connexion</a></li>
					<?php endif; ?>
				</ul>
			</nav>
		</header>

		<section>
			<?=$this->section('main_content')?>
		</section>

		<footer>
		</footer>
	</div>
</body>
</html>