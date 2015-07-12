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
			$router->setBasePath(BASE_URL);

			foreach($this->routes as $route)
			{
				$router->map($route[0], $route[1], $route[2]);
			}

			$matcher = new \W\Router\AltoRouter\Matcher($router);
			$matcher->match();
		}

	}