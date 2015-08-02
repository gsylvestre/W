<?php

	namespace W;

	class App 
	{

		protected $router;

		/**
		 * Constructeur, recevant un array de routes
		 */
		public function __construct(array $routes)
		{
			$this->router = new \AltoRouter();
			$this->router->setBasePath(W_BASE_URL);
			$this->router->addRoutes($routes);
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