<?php

	namespace W\Security;

	class StringUtils 
	{

		/**
		 * Returns a secure random string, url safe
		 * @param  integer $length Length of the string
		 * @return string $string The generated string
		 */
		public static function randomString($length = 80)
		{
			$possibleChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-";
	        $factory = new \RandomLib\Factory;
			$generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));
			$string = $generator->generateString($length, $possibleChars);

	        return $string;
		}

	}