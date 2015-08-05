<?php $this->layout('layout', ['title' => 'Home!']) ?>

<?php $this->start('main_content'); ?>
<h2>Derniers articles</h2>

<?php foreach ($posts as $post): ?>
	
	<h3><a href="<?= $this->url('postDetails', ['id' => $post['id']]); ?>" title="<?= $post['title'] ?>"><?= $post['title'] ?></a></h3>

<?php endforeach; ?>

<?php $this->stop('main_content'); ?>
