<?php

	namespace W\Manager;


	abstract class Manager 
	{

		protected $table;
		protected $dbh;

		public function __construct()
		{
			$this->setTableFromClassName();
			$this->dbh = ConnectionManager::getDbh();
		}

		private function setTableFromClassName()
		{
			$className = get_class($this);
			$tableName = str_replace("Manager", "", $className);
			$tableName = strtolower(str_replace("\\", "", $tableName));
			if (substr($tableName, -1) != "s"){
				$tableName .= "s";
			}
			$this->table = DB_TABLE_PREFIX . $tableName;
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