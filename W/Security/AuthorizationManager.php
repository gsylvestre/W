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

			if (empty($this->user["role"])){
				return false;
			}


			if ($this->user["role"] === $role){
				return true;
			}

			return false;
		}

	}