<?php

	//url
	define("W_BASE_URL", "/formation/w");

	//user authentification
	define("W_DB_USER_TABLE", "users");
	define("W_DB_USERNAME_PROPERTY", "username");
	define("W_DB_EMAIL_PROPERTY", "email");
	define("W_DB_PASSWORD_PROPERTY", "password");
	define("W_DB_TOKEN_PROPERTY", "token");

	//database
    define("W_DB_HOST", "localhost");  
    define("W_DB_USER", "root");     
    define("W_DB_PASS", "");         
    define("W_DB_NAME", "w"); 
    define("W_DB_TABLE_PREFIX", "");

    require("routes.php");