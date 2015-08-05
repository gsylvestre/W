<?php

namespace W;

class App 
{

	protected $config;
	protected $router;

	/**
	 * Constructeur, recevant un array de routes
	 */
	public function __construct(array $w_config, array $w_routes)
	{
		session_start();
		$this->setConfig($w_config);
		$this->router = new \AltoRouter();
		$this->router->setBasePath($this->getConfig('base_url'));
		$this->router->addRoutes($w_routes);
	}

	private function setConfig($w_config)
	{
		$defaultConfig = [
			//url
			'base_url' => '',

		   	//database connection infos
			'db_host' => 'localhost',
		    'db_user' => 'root',
		    'db_pass' => '',
		    'db_name' => '',
		    'db_table_prefix' => '',

			//user authentification
			'security_user_table' => 'users',
			'security_username_property' => 'username',
			'security_email_property' => 'email',
			'security_password_property' => 'password',
			'security_role_property' => 'role',
		];

		$this->config = array_merge($defaultConfig, $w_config);
	}


	/**
	 * Récupère une donnée de configuration
	 * @param   $key Le clef de configuration
	 * @return mixed La valeur de configuration
	 */
	public function getConfig($key)
	{
		return (isset($this->config[$key])) ? $this->config[$key] : null;
	}

	/**
	 * Exécute le routeur
	 */
	public function run()
	{

		$matcher = new \W\Router\AltoRouter\Matcher($this->router);
		$matcher->match();
	}

	/**
	 * Retourne le routeur
	 */
	public function getRouter()
	{
		return $this->router;
	}

}