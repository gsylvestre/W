<?php
	
	namespace Controller;

	use \W\Controller\Controller;
	use \Manager\PostManager;

	class DefaultController extends Controller
	{

		/**
		 * Page d'accueil affichant tous les articles
		 */
		public function home()
		{
			$postManager = new PostManager();
			$posts = $postManager->findAll();

			$this->show('default/home', array("posts" => $posts));
		}

		/**
		 * Page détaillée d'un article
		 * @param  int $id Identifiant de l'article à afficher
		 */
		public function postDetails($id)
		{
			$postManager = new PostManager();
			$post = $postManager->find($id);

			$this->show('default/post_details', array("post" => $post));
		}

	}