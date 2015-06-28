<?php

	require("vendor/autoload.php");
	require("config.php");
	
	$router = new AltoRouter();
	$router->setBasePath('/formation/w2');

	$router->map('GET', '/', 'Default#home');
	$router->map('GET', '/about/', 'Default#about');

	$matcher = new W\AltoRouter\Matcher($router);
	$matcher->match();