<?php

	namespace W\Router\AltoRouter;

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
		 * Cherche une correspondance entre l'URL et les routes, et appelle la méthode appropriée
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
				
				//appelle la méthode, en lui passant les paramètres d'URL en arguments 
				call_user_func_array(array($controller, $methodName), $match['params']);
			}
			else {
				die("Aucune route ne correspond à cette URL");
			}

		}

	}