<?php

	namespace W;

	class App 
	{

		protected $router;
		protected $routes;

		public function __construct(array $routes)
		{
			$this->routes = $routes;
		}

		public function run()
		{
			
			$this->router = new \AltoRouter();
			$this->router->setBasePath(W_BASE_URL);

			foreach($this->routes as $route)
			{
				$this->router->map($route[0], $route[1], $route[2], $route[3]);
			}

			$matcher = new \W\Router\AltoRouter\Matcher($this->router);
			$matcher->match();
		}

		public function getRouter()
		{
			return $this->router;
		}

	}