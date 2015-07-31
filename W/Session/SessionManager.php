<?php

	namespace W\Session;

	class SessionManager
	{

		/**
		 * Constructeur
		 */
		public function __construct()
		{
			$this->start();
		}

		/**
		 * Démarre la session
		 */
		public function start()
		{
			if(!isset($_SESSION)) {
			     session_start();
			}
		}

		/**
		 * Crée ou modifie la valeur d'une clef de la session
		 */
		public function set($key, $value)
		{
			$_SESSION[$key] = $value;
		}

		/**
		 * Récupère la valeur d'une clef de la session
		 */
		public function get($key)
		{
			if(empty($_SESSION[$key])){
				return false;
			}
			return $_SESSION[$key];
		}

		/**
		 * Supprime une clef et sa valeur de la session
		 */
		public function remove($key)
		{
			if (!empty($_SESSION[$key])){
				unset($_SESSION[$key]);
			}
		}

		/**
		 * Supprime toutes les données de la session
		 */
		public function unsetAll()
		{
			session_unset();
		}

		/**
		 * Supprime la session
		 */
		public function destroy()
		{
			session_destroy();
		}

	}