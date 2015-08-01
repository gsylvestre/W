<?php

	namespace W\Manager;

	abstract class Manager 
	{

		/** @var string $table Le nom de la table */
		protected $table;

		/** @var \Pdo $dbh Connexion à la base de données */
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
		 * @return W\Manager $this
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

			return $this;
		}

		/**
		 * Définit le nom de la table
		 * @param string $table Nom de la table
		 * @return W\Manager $this
		 */
		public function setTable($table)
		{
			$this->table = $table;
			return $this;
		}
 
		/**
		 * @param  integer Identifiant
		 * @return mixed Les données (tableau ou objet)
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