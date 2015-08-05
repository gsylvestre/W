<?php

namespace W\View\Plates;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class PlatesExtensions implements ExtensionInterface
{
	/**
	 * Enregistre les nouvelles fonctions dans Plates
	 */
    public function register(Engine $engine)
    {
        $engine->registerFunction('assetUrl', [$this, 'assetUrl']);
        $engine->registerFunction('url', [$this, 'generateUrl']);
        $engine->registerFunction('getFlashes', [$this, 'getFlashes']);
        $engine->registerFunction('hasFlashes', [$this, 'hasFlashes']);
    }

    /**
     * Retourne l'URI absolue d'un asset
     */
    public function assetUrl($path)
    {
        return "//" . $_SERVER['SERVER_NAME'] . W_BASE_URL . '/assets/' . $path;
    }

    /**
     * Retourne l'URI absolue d'une route nommée
     */
    public function generateUrl($routeName, array $params = array())
    {
    	global $app;
    	$router = $app->getRouter();
    	return $router->generate($routeName, $params);
    }

    /**
     * Récupère les messages flash
     */
    public function getFlashes($type = null)
    {
    	$flashManager = new \W\Session\FlashManager();
    	return $flashManager->getFlashes($type);
    }

    /**
     * Vérifie si des messages flash sont disponibles
     */
    public function hasFlashes($type = null)
    {
        $flashManager = new \W\Session\FlashManager();
        return $flashManager->hasFlashes($type);
    }
}
