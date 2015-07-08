<?php $this->layout('layout', ['title' => 'Yo !']) ?>

<?php $this->start('main_content'); ?>
<h1>User Profile</h1>
<p>Hello, <?=$this->e($name)?></p>

<?php $this->stop('main_content'); ?>
