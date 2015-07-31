<?php

	namespace W\Manager;

	abstract class Manager 
	{

		/**
		 * Nom de la table
		 */
		protected $table;

		/**
		 * Connexion à la base
		 */
		protected $dbh;

		/**
		 * Constructeur
		 */
		public function __construct()
		{
			$this->setTableFromClassName();
			$this->dbh = ConnectionManager::getDbh();
		}

		/**
		 * Déduit le nom de la table en fonction du nom du Manager
		 */
		private function setTableFromClassName()
		{
			$className = get_class($this);
			$tableName = str_replace("Manager", "", $className);
			$tableName = strtolower(str_replace("\\", "", $tableName));
			if (substr($tableName, -1) != "s"){
				$tableName .= "s";
			}
			$this->table = W_DB_TABLE_PREFIX . $tableName;
		}

		/**
		 * Écrase le nom de la table
		 */
		public function setTable($table)
		{
			$this->table = $table;
		}
 
		/**
		 * Récupère une ligne de table en fonction de l'identifiant
		 */
		public function find($id)
		{
			if (!is_numeric($id)){
				return false;
			}

			$sql = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id", $id);
			$sth->execute();

			return $sth->fetch();
		}

		/**
		 * Récupère toutes les lignes de la table
		 */
		public function findAll()
		{

			$sql = "SELECT * FROM " . $this->table;
			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			return $sth->fetchAll();
		}

		/**
		 * Efface une ligne en fonction de son identifiant
		 */
		public function delete($id)
		{
			if (!is_numeric($id)){
				return false;
			}

			$sql = "DELETE FROM " . $this->table . " WHERE id = :id LIMIT 1";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id", $id);
			return $sth->execute();
		}

		/**
		 * Ajoute une ligne 
		 */
		public function insert(array $data, $stripTags = true)
		{

			$colNames = array_keys($data);
			$colNamesString = implode(", ", $colNames);

			$sql = "INSERT INTO " . $this->table . " ($colNamesString) VALUES (";
			foreach($data as $key => $value){
				$sql .= ":$key, ";
			}
			$sql = substr($sql, 0, -2);
			$sql .= ")";

			$sth = $this->dbh->prepare($sql);
			foreach($data as $key => $value){
				$value = ($stripTags) ? strip_tags($value) : $value;
				$sth->bindValue(":".$key, $value);
			}
			return $sth->execute();
		}

		/**
		 * Modifie une ligne en fonction d'un identifiant
		 */
		public function update(array $data, $id, $stripTags = true)
		{
			if (!is_numeric($id)){
				return false;
			}

			$colNames = array_keys($data);
			$colNamesString = implode(", ", $colNames);

			$sql = "UPDATE " . $this->table . " SET ";
			foreach($data as $key => $value){
				$sql .= "$key = :$key, ";
			}
			$sql = substr($sql, 0, -2);
			$sql .= " WHERE id = :id";

			echo $sql;

			$sth = $this->dbh->prepare($sql);
			foreach($data as $key => $value){
				$value = ($stripTags) ? strip_tags($value) : $value;
				$sth->bindValue(":".$key, $value);
			}
			$sth->bindValue(":id", $id);
			return $sth->execute();
		}
	}