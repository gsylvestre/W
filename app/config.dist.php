<?php 

$w_config = [
	//url
	'base_url' => '',

   	//database connection infos
	'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => '',
    'db_table_prefix' => '',

	//security
	'security_user_table' => 'users',
	'security_username_property' => 'username',
	'security_email_property' => 'email',
	'security_password_property' => 'password',
	'security_role_property' => 'role',

];

require('routes.php');

