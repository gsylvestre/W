<?php

	namespace Manager;

	use \W\Manager\Manager;

	class PostManager extends Manager
	{

		/**
		 * Compte le nombre d'articles dans la table
		 * @return int Le nombre d'articles
		 */
		public function countAll()
		{
			$sth = $this->dbh->query("SELECT COUNT(*) FROM " . $this->table);

			return $sth->fetchColumn();
		}

	}