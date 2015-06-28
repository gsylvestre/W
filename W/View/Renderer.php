<?php

	namespace W\View;

	class Renderer 
	{

		public function __construct()
		{

		}

		public function render($file, array $data = null, array $options = null)
		{
			$layout = "app/templates/layout.php";
			$content = file_get_contents($layout);

			$main_content = file_get_contents("app/templates/".$file);

			$content = str_replace("{{main_content}}", $main_content, $content);

			echo $content;
			die();
		}

	}