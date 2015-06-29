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
		 * Get current logged in user from session
		 */
		public function getUser()
		{
			$session = new W\Session\SessionManager();
			$user = $session->get("user");
			return $user;
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

	}