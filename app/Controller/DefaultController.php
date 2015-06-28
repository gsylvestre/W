<?php
	
	namespace Controller;

	use \W\Controller\Controller;

	class DefaultController extends Controller
	{

		public function home()
		{
			echo "home !";
		}

		public function about()
		{
			echo "about !";	
			$postManager = new \Manager\PostManager();
			$postManager->delete(2);
			$postManager->insert(
				array(
					"title" => "yo",
					"content" => "dsajfala djlj lf",
					"date_created" => date("Y-m-d H:i:s")
				)
			);
			$postManager->update(
				array(
					"title" => "yo2222",
					"date_created" => date("Y-m-d H:i:s")
				), 4
			);
			$post = $postManager->find(4);
			print_r($post);
		}

	}