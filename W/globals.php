<?php

//global namespace
namespace {

	/**
	 * print_r coké
	 * @param  mixed $var La variable a déboger
	 */
	function debug($var)
	{
		echo '<pre style="padding: 10px; font-family: Consolas, Monospace; background-color: #000; color: #FFF;">';
		print_r($var);
		echo '</pre>';
	}

}