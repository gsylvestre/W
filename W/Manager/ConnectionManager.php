<?php

	namespace W\Manager;

	use \PDO;
	use \PDOException;

	class ConnectionManager
	{

		private static $dbh;

		public static function getDbh()
		{
			if (!self::$dbh){
				self::setNewDbh();
			}
			return self::$dbh;
		}

		public static function setNewDbh()
		{
			try {
			    //connexion à la base avec la classe PDO et le dsn
			    self::$dbh = new PDO('mysql:host='.W_DB_HOST.';dbname='.W_DB_NAME, W_DB_USER, W_DB_PASS, array(
			        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //on s'assure de communiquer en utf8
			        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //on récupère nos données en array associatif par défaut
			        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING         //on affiche les erreurs. À modifier en prod. 
			    ));
			} catch (PDOException $e) { //attrappe les éventuelles erreurs de connexion
			    echo 'Erreur de connexion : ' . $e->getMessage();
			}
		}

	}