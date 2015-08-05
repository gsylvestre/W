<?php $this->layout('layout', ['title' => 'Test avec id!']) ?>

<?php $this->start('main_content'); ?>

<h1><?= $post['title']; ?></h1>
<p><?= $post['content']; ?></p>

<?php $this->stop('main_content'); ?>
