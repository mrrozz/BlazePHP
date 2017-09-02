<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2017, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2017, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
namespace BlazePHP\Database;


/**
 * connMySQL
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class connMySQL extends \BlazePHP\Struct
{
	public $type ='MySQL';

	public $hostname    = 'localhost';
	public $username;
	public $password;
	public $port        = 3306;
	public $socket      = '/tmp/mysql.sock';
	public $database;

	private $C     = false; // holds the connection
	private $CHash = null;

	public $nodeID; // Holds the node ID for a cluster connection when applicable

	private $sql; // Current/Last SQL executed




	/**
	 * Create the connection to the databse if it has not already been done.
	 *
	 * @return boolean - True on success, False on failure
	 */
	public function connect()
	{
		$hashCheck = md5(implode('', array(
			 $this->hostname
			,$this->username
			,$this->password
			,$this->database
			,$this->port
		)));
		if (is_object($this->C) && get_class($this->C) == 'mysqli' && $hashCheck === $this->CHash) {
			return true;
		}
		if ((integer)$this->port !== 3306 && (integer)$this->port > 0) {
			$this->C = new \mysqli($this->hostname, $this->username, $this->password, $this->database, $this->port);
		}
		else if ((string)$this->socket != '/tmp/mysql.sock' && file_exists($this->socket)) {
			$this->C = new \mysqli(
				$this->hostname, $this->username, $this->password, $this->database, false, $this->socket
			);
		}
		else {
			$this->C = new \mysqli($this->hostname, $this->username, $this->password, $this->database);
		}

		if ($this->C->connect_errno) {
			throw new \ErrorException(
				'MySQL connection failure:  [no. '.(string)$this->C->connect_errno.'] '.$this->C->connect_error
			);
			return false;
		}
		$this->CHash = md5(implode('', array(
			 $this->hostname
			,$this->username
			,$this->password
			,$this->database
			,$this->port
		)));
		return true;
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
	 * @return MySQLi Result Set on success
	 */
	public function query($sql)
	{
		$this->connect();
		$this->sql = $sql;
		$result = $this->C->query($sql);
		if ($this->C->error) {
			throw new \ErrorException('MySQL Error: ['.$this->C->errno.'] '.$this->C->error."\n".'SQL: '.$sql);
		}
		return $result;
	}


	/**
	 * Returns the last insert id
	 */
	public function getInsertID()
	{
		$this->connect();
		if (isset($this->C->insert_id)) {
			return $this->C->insert_id;
		}
		return 0;
	}


	/**
	 * Returns the affected rows for the last query
	 **/
	public function getAffectedRows()
	{
		$this->connect();
		if (isset($this->C->affected_rows)) {
			return $this->C->affected_rows;
		}
		return 0;
	}

	/**
	 * Wrapper for escaping a string.  The native real_escape_string takes into
	 * account the encoding of the db table along with the characters that require
	 * escaping.
	 *
	 * @param $string - Any string
	 * @return string - Returns the string escaped
	 */
	public function escape($string)
	{
		$this->connect();
		return $this->C->real_escape_string($string);
	}


	public function quote($string)
	{
		return '\''.$this->escape($string).'\'';
	}


	public function autocommit($autocommit)
	{
		$this->connect();
		return $this->C->autocommit($autocommit);
	}
	public function commit()
	{
		return $this->C->commit();
	}
	public function rollback()
	{
		return $this->C->rollback();
	}

	public function getLastError()
	{
		return $this->C->error;
	}



	public function listTables()
	{
		$this->connect();
		$results = $this->query('SHOW TABLES');
		$tables = array();
		while($row = $results->fetch_array()) {
			$tables[] = $row[0];
		}
		return $tables;
	}

	public function descTable($table)
	{
		$this->connect();
		$results = $this->query('DESC `'.$table.'`');
		$tableDesc = array();
		while($row = $results->fetch_assoc()) {
			$tableDesc[$row['Field']] = array(
				 'type'           => $row['Type']
				,'max_length'     => null
				,'is_nullable'    => ($row['Null'] === 'YES') ? 1 : 0
				,'auto_increment' => (preg_match('/auto_increment/', $row['Extra'])) ? 1 : 0
				,'primary_key'    => (preg_match('/PRI/', $row['Key'])) ? 1 : 0
				,'default'        => $row['Default']
			);
		}

		return $tableDesc;
	}

}
