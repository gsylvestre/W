<?php

	namespace W\AltoRouter;

	class Matcher 
	{

		protected $router; //AltoRouter 

		public function __construct($router)
		{
			$this->router = $router;
		}

		public function setRouter($router)
		{
			$this->router = $router;
		}

		/**
		 * Match current route and call controller method
		 */
		public function match()
		{

			$match = $this->router->match();

			if ($match){

				$callableParts = explode("#", $match["target"]);
				$controllerName = $callableParts[0];
				$methodName = $callableParts[1];
				$controllerFullName = 'Controller\\'.$controllerName."Controller";
				
				$controller = new $controllerFullName();
				$controller->$methodName();
			}
			else {
				echo "404";
			}

		}

	}