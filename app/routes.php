<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'home'],
		['GET', '/post/[i:id]/', 'Default#postDetails', 'postDetails'],
		['GET', '/admin/', 'Admin#home', 'adminHome'],
		['GET', '/admin/administrateurs/ajout/', 'Admin#addAdmin', 'addAdmin'],
		['POST', '/admin/administrateurs/ajout/', 'Admin#addAdminHandler', 'addAdminHandler'],
		['GET|POST', '/connexion/', 'Default#login', 'login'],
		['GET', '/deconnexion/', 'Default#logout', 'logout'],
	);