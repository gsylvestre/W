<?php
	
	namespace Controller;

	use \W\Controller\Controller;

	class DefaultController extends Controller
	{

		public function home()
		{
			$this->show("default/home");
		}

	}