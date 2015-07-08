<?php

	require("vendor/autoload.php");
	require("config.php");
	
	$app = new W\App($routes);
	$app->run();