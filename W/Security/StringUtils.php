<?php

	namespace W\Security;

	class StringUtils 
	{

		public static function randomString($length = 80)
		{
			$possibleChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-";
	        $factory = new \RandomLib\Factory;
			$generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));
			$string = $generator->generateString($length, $possibleChars);

	        return $string;
		}

	}