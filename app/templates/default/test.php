<?php $this->layout('layout', ['title' => 'Test avec id!']) ?>

<?php $this->start('main_content'); ?>

<h1>Test avec id!</h1>
<p>Id : <?= $this->e($id); ?></p>

<?php $this->stop('main_content'); ?>
