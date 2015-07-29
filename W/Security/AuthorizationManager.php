<?php

	namespace W\Security;

	use \W\Session\SessionManager;

	class AuthorizationManager
	{

		private $user;

		public function __construct()
		{
			$session = new SessionManager();
			$this->user = $session->get("user");
		}

		public function isGranted($role)
		{
			if (!empty($this->user[W_DB_ROLE_PROPERTY]) && $this->user[W_DB_ROLE_PROPERTY] === $role){
				return true;
			}

			return false;
		}

	}