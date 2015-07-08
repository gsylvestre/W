<?php

	namespace W\Session;

	class SessionManager
	{

		public function __construct()
		{
			$this->start();
		}


		public function start()
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

		public function remove($key)
		{
			if (!empty($_SESSION[$key])){
				unset($_SESSION[$key]);
			}
		}

		public function unsetAll()
		{
			session_unset();
		}

		public function destroy()
		{
			session_destroy();
		}

	}