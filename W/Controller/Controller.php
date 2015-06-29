<?php

	namespace W\Controller;

	class Controller 
	{

		public function __construct()
		{

		}

		/**
		 * Redirect to an URI
		 */
		public function redirect($url)
		{
			header("Location: $url");
			die();
		}

		/**
		 * Show template file
		 */
		public function show($file, array $data = array())
		{
			$loader = new \Twig_Loader_Filesystem('app/templates');
			$twig = new \Twig_Environment($loader, array(
			    'cache' => 'app/cache',
			));

			//$twig->addGlobal('myStuff', $someVariable);
			
			$template = $twig->loadTemplate($file);
			echo $template->render($data);
		}

		/**
		 * Show a 403 page
		 */
		public function showForbidden()
		{
			//@todo 403
			header('HTTP/1.0 403 Forbidden');
			die("403");
		}

		/**
		 * Show a 404 page
		 */
		public function showNotFound()
		{
			//@todo 404
			header('HTTP/1.0 404 Not Found');
			die("404");
		}

		/**
		 * Get current logged in user from session
		 */
		public function getUser()
		{
			$session = new W\Session\SessionManager();
			$user = $session->get("user");
			return $user;
		}

		/**
		 * Allow ressource access only to specific roles
		 */
		public function allowTo($roles)
		{
			if (!is_array($roles)){
				$roles = [$roles];
			}
			$authorizationManager = new W\Security\Authorization\AuthorizationManager();
			foreach($roles as $role){
				if ($authorizationManager->isGranted($role)){
					return true;
				}
			}

			$this->showForbidden();
		}


	}