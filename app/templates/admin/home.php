<?php $this->layout('layout', ['title' => 'Admin !']) ?>

<?php $this->start('main_content'); ?>
<h1>Admin !</h1>

<?= $postsCount ?> articles en base.

<?php $this->stop('main_content'); ?>
