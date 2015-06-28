<?php

	namespace W\AltoRouter;

	class Matcher 
	{

		protected $router;

		public function __construct($router)
		{
			$this->router = $router;
		}

		public function setRouter($router)
		{
			$this->router = $router;
		}

		public function match()
		{

			$match = $this->router->match();

			if ($match){

				var_dump($match);

				$callableParts = explode("#", $match["target"]);
				$controllerName = $callableParts[0];
				$methodName = $callableParts[1];

				$controllerFullName = 'Controller\\'.$controllerName."Controller";
				echo $controllerFullName;
				$controller = new $controllerFullName();
				$controller->$methodName();


			}
			else {
				echo "404";
			}

		}

	}