<?php
	
	$routes = array(
		['GET', '/', 'Default#home'],
		['GET', '/about/', 'Default#about'],
		['GET', '/about/[i:id]/[:yo]/?', 'Default#aboutTest'],
	);