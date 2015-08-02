<?php
	//autochargement des classes
	require("../vendor/autoload.php");

	//configuration
	require("../app/config.php");
	
	//instancie notre appli en lui passant les routes
	$app = new W\App($w_routes);
	
	//exécute l'appli
	$app->run();