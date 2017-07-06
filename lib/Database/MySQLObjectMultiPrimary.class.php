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
 * MySQL Object Multiple Column Primary class handles all entity relations with
 * a specific table that uses a one or more column primary key.
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class MySQLObjectMultiPrimary extends MySQLObject
{

	protected $__primaryKey = array();

	/**
	 * Returns the database connection information needed for the MySQLObjectManager
	 *
	 */
	public function getManagerInfo()
	{
		$info = new stdClass();
		$info->dbConnectionName = $this::$__dbConnectionName;
		$info->dbTableName      = $this::$__dbTableName;
		return $info;
	}





	/**
	 * Constructor
	 *
	 * @param $primaryKey - An array of key=>values that make up the object's primary key
	 * @param $dbConnection - A master/slave db connection object
	 * @param $dbTableName
	 * @param $attributeList - List of table column mapped attributes Array([column] => [type]....)
	 *
	 */
	public function __construct($primaryKey = null, stdClass $dbConnection = null, $dbTableName = null, $attributeList = null)
	{
		if(!is_array($this->__primaryKey) || count($this->__primaryKey) <= 0) {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - The primaryKey attribute is empty.  This object needs a primary key array set.'
			);
		}
		else if (count($this->__primaryKey) !== count(array_intersect($this->__primaryKey, array_keys($this->__attributeList)))) {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - The values in the primaryKey array do not all match items in the attributeList'
			);
		}

		// Verify the given primary key if it is not null
		if(is_array($primaryKey) && count($this->__primaryKey) > 0) {
			if (count($primaryKey) !== count(array_intersect(array_keys($primaryKey), $this->__primaryKey))) {
				throw new Exception(
					__CLASS__.'::'.__FUNCTION__.' - The primaryKey fields that have been provided are invalid ['
					.implode(', ', array_keys($primaryKey)).'] expecting ['.implode(', ', $this->__primaryKey).']'
				);
			}
		}

		if ($dbConnection === null) {
			if(G::$db->load_data_config === false) {
				throw new ErrorException(
					'MySQLObject: The Environtment configuration is not set to load any database configuration.'
					.'Set Environment::load_data_config = true; and ensure you have conigured a database connection.'
				);
			}
			$db = G::$db;

			if (!$this::$__dbConnectionName || !isset($db->{$this::$__dbConnectionName})) {
				throw new ErrorException(
					'MySQLObject: The $dbConnectionName ['.$this::$__dbConnectionName.'] is invalid.'
				);
			}

			$this->__dbMaster =& $db->{$this::$__dbConnectionName}->master;
			$this->__dbSlave  =& $db->{$this::$__dbConnectionName}->slave;
		}
		else {
			$this->__dbMaster      =& $dbConnection->master;
			$this->__dbSlave       =& $dbConnection->slave;
			$this::$__dbTableName   = $dbTableName;
			$this->__attributeList  = $attributeList;
		}


		if (is_array($primaryKey)) {

			$where = array();
			foreach($primaryKey as $attribute => $value) {
				$where[] = '`'.$attribute.'`='.self::packValue($value, $this->__attributeList[$attribute]);
			}

			$result = $this->__dbSlave->query('SELECT * FROM `'.$this::$__dbTableName.'` WHERE '.implode(' AND ', $where));
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				foreach ($row as $attribute => $value) {
					$this->__attributeChecksum[$attribute] = md5($value);
					$this->__attributeValues[$attribute] = self::unpackValue($value, $this->__attributeList[$attribute]);
				}
				$this->__isNew = false;
			}
			else {
				$this->__isNew = true;
				foreach($primaryKey as $attribute => $value) {
					$this->{$attribute} = $value;
				}
			}
		}
		else {
			foreach ($this->__attributeList as $attribute => $type) {
				$this->__attributeValues[$attribute] = self::unpackValue(null, $this->__attributeList[$attribute]);
			}
			$this->__isNew = true;
		}
	}





	/**
	 * Save the object record to the database
	 *
	 * @return boolean - True on Success, False on Failure
	 */
	public function save()
	{
		if ($this->__error === true) {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - '.$this->__errorMessage
			);
		}

		// Verify that the primary key is populated
		foreach($this->__primaryKey as $attribute) {
			if(empty($this->__attributeValues[$attribute])) {
				throw new Exception(
					__CLASS__.'::'.__FUNCTION__.' - The value for primaryKey['.$attribute.'] is missing.'
					.'  This record cannot be saved without all of the primary key fields populate.'
				);
			}
		}

		$set = array();

		// If this is not new, ensure that the primary key values have not changed.
		if ($this->__isNew !== true) {
			foreach($this->__primaryKey as $attribute) {
				$md5 = md5(
					self::packValue($this->__attributeValues[$attribute], $this->__attributeList[$attribute], false)
				);
				if ($md5 != $this->__attributeChecksum[$attribute]) {
					throw new Exception(
						__CLASS__.'::'.__FUNCTION__.' - This object\'s primary key cannot be changed.'
						.' Changed value ['.$attribute.']'
					);
				}

				$set[] = '`'.$attribute.'`='.self::packValue($this->__attributeValues[$attribute], $this->__attributeList[$attribute]);
			}
		}



		foreach ($this->__attributeList as $attribute => $type) {

			// Skip the primary key values for the SET if this is not a new record
			if($this->__isNew !== true && in_array($attribute, $this->__primaryKey)) {
				continue;
			}

			$value =& $this->__attributeValues[$attribute];

			// Check to see what values have changed.  If this is a new record, only set the values that are not empty;
			if ($this->__isNew === true) {

				if ($attribute == 'time_created') {
					$set[] = '`time_created`=NOW()';
					continue;
				}
				else if ($attribute == 'time_modified') {
					$set[] = '`time_modified`=NOW()';
					continue;
				}
				$set[] = '`'.$attribute.'`='.self::packValue($value, $type);
			}
			else {
				$md5 = md5(
					self::packValue($this->__attributeValues[$attribute], $this->__attributeList[$attribute], false)
				);
				if ($attribute == 'time_modified') {
					$set[] = '`time_modified`=NOW()';
					continue;
				}

				$set[] = '`'.$attribute.'`='.self::packValue($value, $type);
			}
		}


		if (count($set) > 0) {

			$sql = 'REPLACE INTO `'.$this::$__dbTableName.'` SET '.implode(', ', $set);

			if (false === $this->__dbMaster->query($sql)) {
				throw new Exception(
					__CLASS__.'::'.__FUNCTION__.' - '.$this->__dbMaster->error
				);
			}

			return true;
		}
	}





	/**
	 * Delete the object record
	 *
	 * @return boolean - True on Success, False on Failure
	 */
	public function delete()
	{
		// Verify that the primary key is populated
		$where = array();
		foreach($this->__primaryKey as $attribute) {
			if(empty($this->__attributeValues[$attribute])) {
				throw new Exception(
					__CLASS__.'::'.__FUNCTION__.' - The value for primaryKey['.$attribute.'] is missing.'
					.'  This record cannot be deleted without all of the primary key fields populate.'
				);
			}

			$where[] = '`'.$attribute.'`='.self::packValue($this->__attributeValues[$attribute], $this->__attributeList[$attribute]);
		}

		$sql = 'DELETE FROM `'.$this::$__dbTableName.'` WHERE '.implode(' AND ', $where);

		if (false === $this->__dbMaster->query($sql)) {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - '.$this->__dbMaster->error
			);
		}

		$this->clear();

		return true;
	}





	/**
	 * Returns the ID - Returns an array holding each of the primary key fields.
	 *
	 *                  This method is used to set the keys on an object list in the
	 *                  MySQLObjectManager class.
	 */
	public function id()
	{
		return $this->__primaryKey;
	}






































}
