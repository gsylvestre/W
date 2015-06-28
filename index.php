<?php

	require("vendor/autoload.php");
	require("config.php");
	
	$router = new AltoRouter();
	$router->setBasePath(BASEURL);

	$router->map('GET', '/', 'Default#home');
	$router->map('GET', '/about/', 'Default#about');

	$matcher = new W\AltoRouter\Matcher($router);
	$matcher->match();