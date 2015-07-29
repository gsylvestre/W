<?php

	require("../vendor/autoload.php");
	require("../app/config.php");
	
	$app = new W\App($w_routes);
	$app->run();