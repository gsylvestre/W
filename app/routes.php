<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET|POST', '/test/[i:id]/', 'Default#test', 'test']
	);