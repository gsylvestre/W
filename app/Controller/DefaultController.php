<?php
	
	namespace Controller;

	use \W\Controller\BaseController;

	class DefaultController extends BaseController
	{

		public function home()
		{
			echo "home !";
		}

		public function about()
		{
			echo "about !";	
		}

	}