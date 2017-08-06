<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2015, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2015, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
namespace BlazePHP\Database;


/**
 * connPostgres
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class connPostgres extends \BlazePHP\Struct
{
	public $type ='Postgres';

	public $hostname    = 'localhost';
	public $username;
	public $password;
	public $port        = 5432;
	public $database;

	private $C      = false; // holds the connection
	private $CHash  = null;
	private $status = null; // Holds the connection status
	private $result = null;

	public $nodeID; // Holds the node ID for a cluster connection when applicable

	private $sql; // Current/Last SQL executed




	/**
	 * Create the connection to the databse if it has not already been done.
	 *
	 * @return boolean - True on success, False on failure
	 */
	public function connect()
	{
		$connection = implode(' ', array(
			 'host='.    $this->hostname
			,'dbname='.  $this->database
			,'user='.    $this->username
			,'password='.$this->password
			,'port='.    $this->port
		));

		if (is_resource($this->C) && md5($connection) === $this->CHash) {
			return true;
		}
		elseif (is_resource($this->C)) {
			pg_close($this->C);
		}

		try {
			$this->C = pg_connect($connection);
			$stat = pg_connection_status($this->C);

			if ($stat === PGSQL_CONNECTION_OK) {
				$this->status = 'Connection status: [OK]';
			} else {
				$this->status = 'Connection status: [BAD]';
				throw new \Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,$this->status
				)));
			}
		}
		catch(\Exception $e) {
			throw new \ErrorException(
				'Postgres connection failure:  '.$e->getMessage()
			);
			return false;
		}

		$this->CHash = md5($connection);
		return true;
	}


	/**
	 * Returns the current connection hash
	 *
	 * @return string - current connection hash
	 */
	public function connectionHash()
	{
		return $this->CHash;
	}

	/**
	 * Wrapper for the preparation of statements
	 *
	 * @param $sql - Valid SQL
	 * @return MySQLi statment object on success, false on failure
	 */
	public function prepare($sql)
	{
		$this->connect();
		$this->sql = $sql;
		return $this->C->prepare($sql);
	}



	/**
	 * A general query wrapper to catch any errors in the query execution.
	 *
	 * @param $sql - Valid SQL
	 * @return Postgres Result Set on success
	 */
	public function query($sql, $debug=false)
	{
		$this->connect();
		$this->sql = $sql;

		if($debug) {
			printre(array($this->C, $sql));
		}
		$this->result = pg_query($this->C, $sql);
		// printre(pg_result_error($this->result));
		if (!$this->result) {
			$error = pg_result_error($this->result);
			throw new \ErrorException('Posgres Error: ['.$error."\n".'SQL: '.$sql);
		}

		return $this->result;
	}



	/**
	 * Wrapper for escaping a string.
	 *
	 * @param $string - Any string
	 * @return string - Returns the string escaped
	 */
	public function escape($string)
	{
		return pg_escape_string($string);
	}


	public function quote($string)
	{
		return '\''.$this->escape($string).'\'';
	}


	public function begin()
	{
		$this->connect();
		try {
			pg_query($this->C, 'BEGIN');
		}
		catch(\Exception $e) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' '.$e->getMessage()
			)));
		}
		return true;
	}
	public function commit()
	{
		$this->connect();
		try {
			pg_query($this->C, 'COMMIT');
		}
		catch(\Exception $e) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' '.$e->getMessage()
			)));
		}
		return true;
	}
	public function rollback()
	{
		$this->connect();
		try {
			pg_query($this->C, 'ROLLBACK');
		}
		catch(\Exception $e) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' '.$e->getMessage()
			)));
		}
		return true;
	}


	public function listTables()
	{
		$this->connect();
		$sql = array();
		$sql[] = 'SELECT "table_name"';
		$sql[] = 'FROM "information_schema"."tables"';
		$sql[] = 'WHERE "table_schema"=\'public\'';
		$sql[] = 'ORDER BY "table_name" ASC';
		// printre(implode("\n", $sql));
		$result = pg_query($this->C, implode(' ', $sql));
		$tables = array();
		while($row = pg_fetch_assoc($result)) {
			$tables[] = $row['table_name'];
		}
		return $tables;
	}

	public function descTable($table)
	{
		$this->connect();

		try {
			$sql = array();
			$sql[] = 'SELECT';
			$sql[] = '  "c"."column_name"';
			// $sql[] = ' ,"c"."data_type"';
			$sql[] = 'FROM';
			$sql[] = '      "information_schema"."table_constraints"       AS "tc"';
			$sql[] = ' JOIN "information_schema"."constraint_column_usage" AS "ccu" USING ("constraint_schema", "constraint_name")';
			$sql[] = ' JOIN "information_schema"."columns"                 AS "c"   ON "c"."table_schema"  = "tc"."constraint_schema"';
			$sql[] = '                                                             AND "tc"."table_name"   = "c"."table_name"';
			$sql[] = '                                                             AND "ccu"."column_name" = "c"."column_name"';
			$sql[] = 'WHERE';
			$sql[] = '     "tc"."constraint_type" = \'PRIMARY KEY\'';
			$sql[] = ' AND "tc"."table_name" = \''.$table.'\'';
			// printre(implode("\n", $sql));
			$result = pg_query($this->C,implode(' ', $sql));
			if(pg_num_rows($result) <= 0) {
				// printre(implode("\n", $sql));
				throw new \Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,'The table ['.$table.'] does not have a primary key.'
				)));
			}
			$primaryKeyFields = array();
			while($row = pg_fetch_assoc($result)) {
				$primaryKeyFields[] = $row['column_name'];
			}

			$sql = array();
			$sql[] = ' ';
			$sql[] = 'SELECT';
			$sql[] = '  "column_name"';
			$sql[] = ' ,"data_type"';
			$sql[] = ' ,"character_maximum_length"';
			$sql[] = ' ,"is_nullable"';
			$sql[] = ' ,"column_default"';
			// $sql[] = ' ,*';
			$sql[] = 'FROM';
			$sql[] = '      "information_schema"."columns"';
			$sql[] = 'WHERE';
			$sql[] = '     "table_name" = \''.$table.'\'';
			// printre(implode("\n", $sql));

			$result = pg_query($this->C,implode(' ', $sql));
			if(pg_num_rows($result) <= 0) {
				throw new Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,'The table ['.$table.'] was not found within "information_schema"."columns"'
				)));
			}
			$tableDesc = array();
			while($row = pg_fetch_assoc($result)) {
				$tableDesc[$row['column_name']] = array(
					 'type'        => $row['data_type']
					,'max_length'  => $row['character_maximum_length']
					,'is_nullable' => ($row['is_nullable'] === 'YES') ? 1 : 0
					,'auto_increment' => (preg_match('/seq\'\:\:regclass/', $row['column_default'])) ? 1 : 0
					,'primary_key'    => (in_array($row['column_name'], $primaryKeyFields)) ? 1 : 0
					,'default'        => $row['column_default']
				);
			}
			return $tableDesc;
		}
		catch(\Exception $e) {
			return $e->getMessage();
		}
	}
}
