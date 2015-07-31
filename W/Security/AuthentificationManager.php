<?php

	namespace W\Security;

	use W\Security\StringUtils;
	use \W\Session\SessionManager;

	class AuthentificationManager
	{

		/**
		 * Données par défaut pour le système d'authentification
		 */
		protected $table = "users";
		protected $usernameProperty = "username";
		protected $emailProperty = "email";
		protected $passwordProperty = "password";
		protected $roleProperty = "role";

		/**
		 * Constructeur
		 */
		public function __construct()
		{
			$this->getConfigValues();
		}

		/**
		 * Écrase les configurations par défaut par les constantes définies par l'utilisateur (config.php)
		 */
		protected function getConfigValues()
		{
			if (defined(W_DB_USER_TABLE)) $this->table = W_DB_USER_TABLE;
			if (defined(W_DB_USERNAME_PROPERTY)) $this->usernameProperty = W_DB_USERNAME_PROPERTY;
			if (defined(W_DB_EMAIL_PROPERTY)) $this->emailProperty = W_DB_EMAIL_PROPERTY;
			if (defined(W_DB_PASSWORD_PROPERTY)) $this->passwordProperty = W_DB_PASSWORD_PROPERTY;
			if (defined(W_DB_ROLE_PROPERTY)) $this->roleProperty = W_DB_ROLE_PROPERTY;
		}

		/**
		 * Vérifie qu'une combinaison d'email/username et mot de passe (en clair) sont présents en bdd et valides
		 */
		public function isValidLoginInfo($usernameOrEmail, $plainPassword)
		{
			$foundUser = $this->getUserByUsernameOrEmail($usernameOrEmail);
			if (!$foundUser){
				return 0;
			}

			if (password_verify($plainPassword, $foundUser[$this->passwordProperty])){
				return $foundUser['id'];
			}

			return 0;
		}

		/**
		 * Récupère un utilisateur en fonction de son email ou de son pseudo
		 */
		public function getUserByUsernameOrEmail($usernameOrEmail)
		{
			$sql = "SELECT * FROM " . $this->table . 
					" WHERE " . $this->usernameProperty . " = :username OR " . 
					$this->emailProperty . " = :email LIMIT 1";
			$dbh = W\Manager\ConnectionManager::getDbh();
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":username", $usernameOrEmail);
			$sth->bindValue(":email", $usernameOrEmail);
			if ($sth->execute()){
				$foundUser = $sth->fetch();
				if ($foundUser){
					return $foundUser;
				}
			}

			return false;
		}

		/**
		 * Récupère un utilisateur en fonction de son identifiant
		 */
		public function getUserById($userId)
		{
			if (!is_numeric($userId)){
				return false;
			}
			$sql = "SELECT * FROM " . $this->table . 
					" WHERE id = :userId LIMIT 1";
			$dbh = W\Manager\ConnectionManager::getDbh();
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":userId", $userId);
			if ($sth->execute()){
				$foundUser = $sth->fetch();
				if ($foundUser){
					return $foundUser;
				}
			}

			return false;
		}

		/**
		 * Utilise les données utilisateurs présentes en base pour mettre à jour les données en session
		 */
		public function refreshUser()
		{
			$userFromSession = $this->getLoggedUser();
			if ($userFromSession){
				$userFromDb = $this->getUserById($userFromSession['id']);
				if ($userFromDb){
					$session = new SessionManager();
					$session->set("user", $userFromDb);
					return true;
				}
			}

			return false;
		}

		/**
		 * Connecte un utilisateur
		 */
		public function logUserIn($user)
		{
			$session = new SessionManager();
			$session->set("user", $user);
		}

		/**
		 * Déconnecte un utilisateur
		 */
		public function logUserOut()
		{
			$session = new SessionManager();
			$session->unset("user");
		}

		/**
		 * Retourne les données présente en session sur l'utilisateur connecté
		 */
		public function getLoggedUser()
		{
			$session = new SessionManager();
			return $session->get("user");
		}
	}