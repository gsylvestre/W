<?php

	require("vendor/autoload.php");
	require("config.php");
	
	$router = new AltoRouter();
	$router->setBasePath(BASE_URL);

	$router->map('GET', '/', 'Default#home');
	$router->map('GET', '/about/', 'Default#about');
	$router->map('GET', '/about/[i:id]/[:yo]/?', 'Default#aboutTest');

	$matcher = new W\AltoRouter\Matcher($router);
	$matcher->match();