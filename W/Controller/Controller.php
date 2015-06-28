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
		public function show($file, array $data = null, array $options = null)
		{
			$renderer = new \W\View\Renderer();
			$renderer->render($file, $data, $options);
		}

	}