<?php

	namespace W\Session;

	class SessionManager
	{

		public function __construct()
		{
			if(!isset($_SESSION)) {
			     session_start();
			}
		}

		public function set($key, $value)
		{
			$_SESSION[$key] = $value;
		}

		public function get($key)
		{
			if(empty($_SESSION[$key])){
				return false;
			}
			return $_SESSION[$key];
		}

		public function unset($key)
		{
			if (!empty($_SESSION[$key])){
				unset($_SESSION[$key]);
			}
		}

	}