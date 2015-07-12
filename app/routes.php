<?php
	
	$routes = array(
		['GET', '/', 'Default#home'],
		['GET', '/about/', 'Default#about'],
		['GET', '/home2/test/', 'Default#hometwo'],
		['GET', '/about/[i:id]/[:yo]/?', 'Default#aboutTest'],
	);