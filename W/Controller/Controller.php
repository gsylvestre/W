<?php

	namespace W\Controller;

	class Controller 
	{

		public function __construct()
		{

		}

		public function redirect($url)
		{
			header("Location: $url");
			die();
		}

	}