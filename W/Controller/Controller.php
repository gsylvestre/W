<?php

	namespace W\Controller;

	use W\Security\AuthenticationManager;
	use W\Security\AuthorizationManager;

	class Controller 
	{

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
			$templates = new \League\Plates\Engine('app/templates');

			// Render a template
			echo $templates->render($file, $data);
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
			$authenticationManager = new AuthenticationManager();
			$user = $authenticationManager->getLoggedUser();
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
			$authorizationManager = new AuthorizationManager();
			foreach($roles as $role){
				if ($authorizationManager->isGranted($role)){
					return true;
				}
			}

			$this->showForbidden();
		}


	}