<?php

	namespace W\Manager;

	abstract class Manager 
	{

		protected $table;

		public function __construct()
		{
			$this->setTableFromClassName();
		}

		private function setTableFromClassName()
		{
			$className = get_class($this);
			$tableName = str_replace("Manager", "", $className) . "s";
			$tableName = strtolower(str_replace("\\", "", $tableName));
			$this->table = $tableName;
		}

		public function setTable($table)
		{
			$this->table = $table;
		}
 

		public function delete($id)
		{

		}

		public function find($id)
		{

		}

	}