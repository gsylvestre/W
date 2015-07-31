<?php

	namespace W;

	class App 
	{

		protected $router;
		protected $routes;

		/**
		 * Constructeur, recevant un array de routes
		 */
		public function __construct(array $routes)
		{
			$this->routes = $routes;

			$this->router = new \AltoRouter();
			$this->router->setBasePath(W_BASE_URL);
		}

		/**
		 * Exécute le routeur
		 */
		public function run()
		{
			foreach($this->routes as $route)
			{
				$this->router->map($route[0], $route[1], $route[2], $route[3]);
			}

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