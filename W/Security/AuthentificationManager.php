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
			$sql = "SELECT * FROM " . $this->table . 
					" WHERE " . $this->usernameProperty . " = :username OR " . 
					$this->emailProperty . " = :email LIMIT 1";
			$dbh = W\Manager\ConnectionManager::getDbh();
			$sth = $dbh->prepare($sql);
			$sth->bindValue(":username", $usernameOrEmail);
			$sth->bindValue(":email", $usernameOrEmail);
			$sth->execute();
			$foundUser = $sth->fetch();

			if (!$foundUser){
				return false;
			}

			$hashedPassword = StringUtils::hashPassword($plainPassword);
			$passwordMatch = StringUtils::stringEquals($hashedPassword, $foundUser[$this->passwordProperty]);
			if ($passwordMatch){
				return $foundUser;
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