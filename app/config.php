<?php

	//user authentification
	define("DB_USER_TABLE", "users");
	define("DB_USERNAME_PROPERTY", "username");
	define("DB_EMAIL_PROPERTY", "email");
	define("DB_PASSWORD_PROPERTY", "password");
	define("DB_TOKEN_PROPERTY", "token");

	//url
	define("BASE_URL", "/formation/w");

	//database
    define("DB_HOST", "localhost");  
    define("DB_USER", "root");     
    define("DB_PASS", "");         
    define("DB_NAME", "w"); 
    define("DB_TABLE_PREFIX", "");

    require("routes.php");