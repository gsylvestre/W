<?php

namespace W\Session;

use W\Session\SessionManager;

class FlashManager 
{

	protected $sessionManager;

	public function __construct()
	{
		$this->sessionManager = new SessionManager();
	}


	/**
	 * Ajoute un message flash
	 * @param string $message Le message flash
	 * @param string $type    Le type de message (notice, error, etc.)
	 */
	public function addFlash($message, $type)
	{
		//ajoute un tableau vide si c'est le premier flash
		if (!$this->sessionManager->get('flashes')){
			$this->sessionManager->set('flashes', []);
		}

		//ajoute ce type si non-présent
		$flashes = $this->sessionManager->get('flashes');
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
		if (!$this->sessionManager->hasFlash()){
			return null;
		}

		$flashes = $this->sessionManager->get("flashes");

		if (!$type){
			$this->sessionManager->unset("flashes");
			return $flashes;
		}

		if ($this->sessionManager->hasFlash($type)){
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
		$flashes = $this->sessionManager->get('flashes');
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