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


		/**
		 * Ajoute un message flash
		 * @param string $message Le message flash
		 * @param string $type    Le type de message (notice, error, etc.)
		 */
		public function addFlash($message, $type)
		{
			//ajoute un tableau vide si c'est le premier flash
			if (!$this->get('flashes')){
				$this->set('flashes', []);
			}

			//ajoute ce type si non-présent
			$flashes = $this->get('flashes');
			if (!isset($flashes[$type])){
				$flashes[$type] = [];
			}

			//ajoute le message
			$flashes[$type][] = $message;
		}

		/**
		 * Récupère les messages flash, et les supprime
		 * @param  string $type Type de messages flash à récupérer
		 * @return mixed       Les messages, ou null
		 */
		public function getFlashes($type = null)
		{
			if (!$this->hasFlash()){
				return null;
			}

			$flashes = $this->get("flashes");

			if (!$type){
				$this->unset("flashes");
				return $flashes;
			}

			if ($this->hasFlash($type)){
				unset($_SESSION['flashes'][$type]);
				return $flashes[$type];
			}

			return null;
		}

		/**
		 * Vérifie si des messages flash sont présents
		 * @param  string  $type Le type de message à vérifier
		 * @return boolean       True si présent, false sinon 
		 */
		public function hasFlash($type = null)
		{
			$flashes = $this->get('flashes');
			if (!$flashes){
				return false;
			}
			if (!$type && !empty($flashes)){
				return true;
			}
			if ($type && array_key_exists($type, $flashes) && !empty($flashes[$type])){
				return true;
			}

			return false;
		}

	}