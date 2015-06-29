<?php

	namespace W\Security\Authentification;

	use W\Security\StringUtils;

	class AuthentificationManager
	{

		protected $table = "users";
		protected $usernameProperty = "username";
		protected $emailProperty = "email";
		protected $passwordProperty = "password";
		protected $tokenProperty = "token";

		public function __construct()
		{
			$this->getConfigValues();
		}

		protected function getConfigValues()
		{
			if (defined(DB_USER_TABLE)) $this->table = DB_USER_TABLE;
			if (defined(DB_USERNAME_PROPERTY)) $this->usernameProperty = DB_USERNAME_PROPERTY;
			if (defined(DB_EMAIL_PROPERTY)) $this->emailProperty = DB_EMAIL_PROPERTY;
			if (defined(DB_PASSWORD_PROPERTY)) $this->passwordProperty = DB_PASSWORD_PROPERTY;
			if (defined(DB_TOKEN_PROPERTY)) $this->tokenProperty = DB_TOKEN_PROPERTY;
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
			$session = new \W\Session\SessionManager();
			$session->set("user", $user);
		}

		public function logUserOut()
		{
			$session = new \W\Session\SessionManager();
			$session->unset("user");
		}
	}