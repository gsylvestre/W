<?php

	namespace W\Security;

	use W\Security\StringUtils;
	use \W\Session\SessionManager;

	class AuthentificationManager
	{

		protected $table = "users";
		protected $usernameProperty = "username";
		protected $emailProperty = "email";
		protected $passwordProperty = "password";
		protected $roleProperty = "role";

		public function __construct()
		{
			$this->getConfigValues();
		}

		protected function getConfigValues()
		{
			if (defined(W_DB_USER_TABLE)) $this->table = W_DB_USER_TABLE;
			if (defined(W_DB_USERNAME_PROPERTY)) $this->usernameProperty = W_DB_USERNAME_PROPERTY;
			if (defined(W_DB_EMAIL_PROPERTY)) $this->emailProperty = W_DB_EMAIL_PROPERTY;
			if (defined(W_DB_PASSWORD_PROPERTY)) $this->passwordProperty = W_DB_PASSWORD_PROPERTY;
			if (defined(W_DB_ROLE_PROPERTY)) $this->roleProperty = W_DB_ROLE_PROPERTY;
		}

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

		public function logUserIn($user)
		{
			$session = new SessionManager();
			$session->set("user", $user);
		}

		public function logUserOut()
		{
			$session = new SessionManager();
			$session->unset("user");
		}

		public function getLoggedUser()
		{
			$session = new SessionManager();
			$user = $session->get("user");
			return $user;
		}
	}