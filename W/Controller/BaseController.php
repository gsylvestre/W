<?php

	namespace W\Controller;

	class BaseController 
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