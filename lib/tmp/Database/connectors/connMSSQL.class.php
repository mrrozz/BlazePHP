<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2024, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2024, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
namespace BlazePHP\Database;


/**
 * Struct - MSSQL Connector
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class connMSSQL extends Struct
{
	public $type ='MSSQL';

	public $hostname    = 'localhost';
	public $username;
	public $password;
	//public $port        = null;
	//public $socket      = '/tmp/mysql.sock';
	public $database;

	private $C = false; // holds the connection

	public $nodeID; // Holds the node ID for a cluster connection when applicable

	private $sql; // Current/Last SQL executed




	/**
	 * Create the connection to the databse if it has not already been done.
	 *
	 * @return boolean - True on success, False on failure
	 */
	// public static $msDbUser = 'sa';
	// public static $msDbPass = '43tap9834ap9otwy!@#';
	// public static $msDbName = 'SFSDB';
	// public static $msDbHost = '10.212.1.30';
	// new PDO('dblib:host='.C::$msDbHost.';dbname='.C::$msDbName, C::$msDbUser, C::$msDbPass);

	public function connect()
	{
		if (is_object($this->C) && get_class($this->C) == 'PDO') {
			return true;
		}

		try {
			//$this->C = new mysqli($this->hostname, $this->username, $this->password, $this->database);
			$this->C = new PDO('dblib:host='.$this->hostname.';dbname='.$this->database, $this->username, $this->password);
		}
		catch(Exception $e) {
			throw new ErrorException(
				'MSSQL connection failure: '.$e->getMessage()
			);
		}

		return true;
	}




	/**
	 * A general query wrapper to catch any errors in the query execution.
	 *
	 * @param $sql - Valid SQL
	 * @return MySQLi Result Set on success
	 */
	public function query($sql)
	{
		$this->sql = $sql;

		if (!is_object($this->C) || get_class($this->C) != 'PDO') {
			$this->connect();
		}

		$results = $this->C->query($sql, \PDO::FETCH_ASSOC);

		if($results === false) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,implode("\n", $this->C->errorInfo())
				,'SQL: '.$sql
			)));
		}

		return $results;
	}



	/**
	 * A wrapper for preparing statments
	 *
	 * @param $sql - Valid SQL
	 * @return PDOStatement prepared PDO statement object
	 */
	public function prepare($sql)
	{
		$this->sql = $sql;

		if (!is_object($this->C) || get_class($this->C) != 'PDO') {
			$this->connect();
		}

		$preparedStatement = null;
		try {
			$preparedStatement = $this->C->prepare($sql);

			if($preparedStatement === false) {
				throw new Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,implode("\n", $this->C->errorInfo())
					,'SQL: '.$sql
				)));
			}

		} catch (PDOException $ex) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,implode("\n", $ex->$errorInfo)
				,'SQL: '.$sql
			)));
		}

		return $preparedStatement;
	}



	/**
	 * Wrapper for beginning a transaction
	 *
	 * @return boolean True when successful, false otherwise
	 * @throws Exception if the transaction could not be started; either due
	 *		   to it already being started, or the driver not supporting them
	 */
	public function begin() {
		$result = false;
		try {
			$result = $this->C->beginTransaction();

		} catch (PDOException $ex) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,implode("\n", $ex->$errorInfo)
			)));
		}

		return $result;
	}


	/**
	 * Wrapper for comitting a transaction
	 *
	 * @return boolean True when successful, false otherwise
	 * @throws Exception if there was no transaction started
	 */
	public function commit() {
		$result = false;
		try {
			$result = $this->C->commit();

		} catch (PDOException $ex) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,"Cannot commit non-existant transaction"
			)));
		}

		return $result;
	}


	/**
	 * Wrapper for rolling a transaction back
	 *
	 * @return boolean True when successful, false otherwise
	 * @throws Exception if there was no transaction started
	 */
	public function rollback() {
		$result = false;
		try {
			$result = $this->C->rollback();

		} catch (PDOException $ex) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,"Cannot rollback non-existant transaction"
			)));
		}

		return $result;
	}



	/**
	 * A general wrapper for PDO::exec()
	 *
	 * @param string $sql - Valid SQL
	 * @return int Number of affected rows
	 * @throws Exception when PDO::exec() returns boolean false
	 */
	public function exec($sql) {
		$this->sql = $sql;

		if (!is_object($this->C) || get_class($this->C) != 'PDO') {
			$this->connect();
		}

		$affectedRows = $this->C->exec($sql);

		if($affectedRows === false) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,implode("\n", $this->C->errorInfo())
				,'SQL: '.$sql
			)));
		}

		return $affectedRows;
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
		if (!is_resource($this->C)) {
			$this->connect();
		}
		return $this->C->quote($string);
	}



	public function getLastError()
	{
		return $this->C->errorInfo();
	}

}
