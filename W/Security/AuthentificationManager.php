<?php

namespace W\Security;

use W\Security\StringUtils;
use W\Manager\UserManager;

class AuthentificationManager
{

	/**
	 * Vérifie qu'une combinaison d'email/username et mot de passe (en clair) sont présents en bdd et valides
	 */
	public function isValidLoginInfo($usernameOrEmail, $plainPassword)
	{

		$app = getApp();

		$userManager = new UserManager();
		$usernameOrEmail = strip_tags(trim($usernameOrEmail));
		$foundUser = $userManager->getUserByUsernameOrEmail($usernameOrEmail);
		if (!$foundUser){
			return 0;
		}

		if (password_verify($plainPassword, $foundUser[$app->getConfig('security_password_property')])){
			return $foundUser['id'];
		}

		return 0;
	}

	/**
	 * Connecte un utilisateur
	 */
	public function logUserIn($user)
	{
		$_SESSION["user"] = $user;
	}

	/**
	 * Déconnecte un utilisateur
	 */
	public function logUserOut()
	{
		if (isset($_SESSION["user"])){
			unset($_SESSION["user"]);
		}
	}

	/**
	 * Retourne les données présente en session sur l'utilisateur connecté
	 */
	public function getLoggedUser()
	{
		return (isset($_SESSION["user"])) ? $_SESSION['user'] : null;
	}

	

	/**
	 * Utilise les données utilisateurs présentes en base pour mettre à jour les données en session
	 */
	public function refreshUser()
	{
		$userManager = new UserManager();
		$userFromSession = $this->getLoggedUser();
		if ($userFromSession){
			$userFromDb = $userManager->find($userFromSession['id']);
			if ($userFromDb){
				$_SESSION["user"] = $userFromDb;
				return true;
			}
		}

		return false;
	}
}