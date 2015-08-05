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

	/**
	 * Affiche et traite le formulaire de connexion
	 */
	public function login()
	{
		$userManager = new \Manager\UserManager();
		$error = "";

		if (!empty($_POST)){

			//instance du auth. manager
			$authentificationManager = new \W\Security\AuthentificationManager();

			$userId = $authentificationManager->isValidLoginInfo($_POST['username'], $_POST['password']);
			if ($userId){
				$foundUser = $userManager->find($userId);
				$authentificationManager->logUserIn($foundUser);
				$this->redirectToRoute("adminHome");
			}
			else {
				$error = "Votre pseudo/email ou votre mot de passe est erronné.";
			}
		}

		$this->show('default/login', array('error' => $error));
	}

	/**
	 * Déconnexion, puis redirection vers l'accueil
	 */
	public function logout()
	{
		$authentificationManager = new \W\Security\AuthentificationManager();
		$authentificationManager->logUserOut();
		$this->redirectToRoute('home');
	}

}