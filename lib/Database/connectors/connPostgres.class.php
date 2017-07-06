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

	public $nodeID; // Holds the node ID for a cluster connection when applicable

	private $sql; // Current/Last SQL executed




	/**
	 * Create the connection to the databse if it has not already been done.
	 *
	 * @return boolean - True on success, False on failure
	 */
	public function connect($reconnect=false)
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
		$this->sql = $sql;

		if (!is_object($this->C) || get_class($this->C) != 'mysqli') {
			$this->connect();
		}

		return $this->C->prepare($sql);
	}



	/**
	 * A general query wrapper to catch any errors in the query execution.
	 *
	 * @param $sql - Valid SQL
	 * @return Postgres Result Set on success
	 */
	public function query($sql)
	{
		$this->sql = $sql;

		if (!is_object($this->C) || get_class($this->C) != 'postgres') {
			$this->connect();
		}
		// printre($this);
		$result = pg_query($this->C, $sql);
		if (!$result) {
			$error = pg_result_error($result);
			throw new \ErrorException('Posgres Error: ['.$error."\n".'SQL: '.$sql);
		}
		return $result;
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
		return pg_escape_string($string);
	}


	public function quote($string)
	{
		return '\''.$this->escape($string).'\'';
	}


	public function begin()
	{
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
}
