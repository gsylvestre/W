<?php

	namespace W\View\Plates;

	use League\Plates\Engine;
	use League\Plates\Extension\ExtensionInterface;

	class PlatesExtensions implements ExtensionInterface
	{
	    public function register(Engine $engine)
	    {
	        $engine->registerFunction('assetUrl', [$this, 'assetUrl']);
	        $engine->registerFunction('url', [$this, 'generateUrl']);
	    }

	    public function assetUrl($path)
	    {
	        return "//" . $_SERVER['SERVER_NAME'] . W_BASE_URL . '/assets/' . $path;
	    }

	    public function generateUrl($routeName, array $params = array())
	    {
	    	global $app;
	    	$router = $app->getRouter();
	    	return $router->generate($routeName, $params);
	    }
	}
