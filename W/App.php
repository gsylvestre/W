<?php

	namespace W;

	class App 
	{

		protected $routes;

		public function __construct(array $routes)
		{
			$this->routes = $routes;
		}

		public function run()
		{
			
			$router = new \AltoRouter();
			$router->setBasePath(W_BASE_URL);

			$router->addRoutes($this->routes);

			$matcher = new \W\Router\AltoRouter\Matcher($router);
			$matcher->match();
		}

	}