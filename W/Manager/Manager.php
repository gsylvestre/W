<?php

	namespace W\Manager;

	use \PDO;
	use \PDOException;

	abstract class Manager 
	{

		protected $table;
		protected $dbh;

		public function __construct()
		{
			$this->setTableFromClassName();
			$this->setDbh();
		}

		private function setDbh()
		{
		    try {
		        //connexion à la base avec la classe PDO et le dsn
		        $this->dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, array(
		            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //on s'assure de communiquer en utf8
		            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //on récupère nos données en array associatif par défaut
		            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING         //on affiche les erreurs. À modifier en prod. 
		        ));
		    } catch (PDOException $e) { //attrappe les éventuelles erreurs de connexion
		        echo 'Erreur de connexion : ' . $e->getMessage();
		    }
		}

		private function setTableFromClassName()
		{
			$className = get_class($this);
			$tableName = str_replace("Manager", "", $className);
			$tableName = strtolower(str_replace("\\", "", $tableName));
			if (substr($tableName, -1) != "s"){
				$tableName .= "s";
			}
			$this->table = $tableName;
		}

		public function setTable($table)
		{
			$this->table = $table;
		}
 

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

		public function findAll()
		{

			$sql = "SELECT * FROM " . $this->table;
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id", $id);
			$sth->execute();

			return $sth->fetchAll();
		}

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


		public function insert(array $data)
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
				$sth->bindValue(":".$key, $value);
			}
			return $sth->execute();
		}


		public function update(array $data, $id)
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
				$sth->bindValue(":".$key, $value);
			}
			$sth->bindValue(":id", $id);
			return $sth->execute();
		}
	}