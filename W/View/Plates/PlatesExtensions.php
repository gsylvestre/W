<?php

	namespace W\View\Plates;

	use League\Plates\Engine;
	use League\Plates\Extension\ExtensionInterface;

	class PlatesExtensions implements ExtensionInterface
	{
	    public function register(Engine $engine)
	    {
	        $engine->registerFunction('assetUrl', [$this, 'assetUrl']);
	        //$engine->registerFunction('lowercase', [$this, 'lowercaseString']);
	    }

	    public function assetUrl($path)
	    {
	        return "//" . $_SERVER['SERVER_NAME'] . BASE_URL . '/assets/' . $path;
	    }

	    /*
	    public function lowercaseString($var)
	    {
	        return strtolower($var);
	    }
	    */
	}
