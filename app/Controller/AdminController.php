<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\PostManager;

class AdminController extends Controller
{
	/**
	 * Page d'accueil de l'interface d'administration
	 */
	public function home()
	{
		//réserve cette page seulement aux utilisateurs connectés ayant le rôle "some_role"
		$this->allowTo('some_role');

		$postManager = new PostManager();
		$postsCount = $postManager->countAll();

		$this->show('admin/home', array("postsCount" => $postsCount));
	}

	/**
	 * Inscription d'un nouvel administrateur
	 */
	public function addAdmin()
	{
		$this->show('admin/add_admin');
	}

	/**
	 * Inscription d'un nouvel administrateur (formulaire soumis)
	 */
	public function addAdminHandler()
	{
		debug($_POST);

		//boucle ninja
		//comme extract(), mais avec sécurisation des données
		foreach($_POST as $k => $v){
			$$k = strip_tags(trim($v));
		}

		//erreurs de validation
		$errors = [];

		//instance du auth. manager
		$userManager = new \W\Manager\UserManager();

		//validation du username
		if (strlen($username) < 3){
			$errors['username'] = "Votre nom d'utilisateur est trop court. Minimum 3 caractères.";
		}
		elseif( $userManager->getUserByUsernameOrEmail($username) ){
			$errors['username'] = "Ce nom d'utilisateur est déjà utilisé.";
		}

		//validation de l'email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Votre email n'est pas valide.";
		}
		elseif( $userManager->getUserByUsernameOrEmail($email) ){
			$errors['email'] = "Cet email est déjà enregistré ici.";
		}

		//validation du mot de passe
		if (strlen($password) < 6){
			$errors['password'] = "Votre mot de passe doit contenir au moins 6 caractères.";
		}
		elseif($password !== $password_confirm){
			$errors['password_confirm'] = "Vos mots de passe ne concordent pas.";
		}

		//si aucune erreur...
		if (empty($errors)){
			//prépare les données pour l'insertion
			$user = [
				"username" => $username,
				"email" => $email,
				"password" => password_hash($password, PASSWORD_DEFAULT),
				"role" => "admin",
			];

			//insert l'adminstrateur en bdd
			$userManager = new \Manager\UserManager();
			if ($userManager->insert($user)){
				$this->redirectToRoute("adminHome");
			}

		}

		$this->show('admin/add_admin', ["errors" => $errors]);
	}
}