<?php

namespace W\Session;

class FlashManager 
{

	/**
	 * Ajoute un message flash
	 * @param string $message Le message flash
	 * @param string $type    Le type de message (notice, error, etc.)
	 */
	public function addFlash($message, $type)
	{
		//initialise le tableau vide si non présent
		if (!isset($_SESSION['flashes'][$type])){
			$_SESSION'flashes'][$type] = [];
		}

		//ajoute le message
		$_SESSION['flashes'][$type][] = $message;
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

		$flashes = $_SESSION["flashes"];

		if (!$type){
			unset($_SESSION["flashes"]);
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
		if (!$_SESSION["flashes"]){
			return false;
		}
		//sans type, et flashes présent
		if (!$type && !empty($_SESSION["flashes"])){
			return true;
		}
		//avec type, et type présent
		if ($type && array_key_exists($type, $_SESSION["flashes"]) && !empty($_SESSION["flashes"][$type])){
			return true;
		}

		return false;
	}
}