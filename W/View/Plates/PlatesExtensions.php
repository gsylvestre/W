<?php

namespace W\View\Plates;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

/**
 * @link http://platesphp.com/engine/extensions/ Documentation Plates
 */
class PlatesExtensions implements ExtensionInterface
{
	/**
	 * Enregistre les nouvelles fonctions dans Plates
	 */
    public function register(Engine $engine)
    {
        $engine->registerFunction('assetUrl', [$this, 'assetUrl']);
        $engine->registerFunction('url', [$this, 'generateUrl']);
    }

    /**
     * Retourne l'URI absolue d'un asset
     */
    public function assetUrl($path)
    {
        $app = getApp();
        return "//" . $_SERVER['SERVER_NAME'] . $app->getConfig('base_url') . '/assets/' . $path;
    }

    /**
     * Retourne l'URI absolue d'une route nommée
     */
    public function generateUrl($routeName, array $params = array())
    {
    	$app = getApp();
    	$router = $app->getRouter();
    	return $router->generate($routeName, $params);
    }
}
