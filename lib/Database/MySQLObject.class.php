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
use \BlazePHP\Database\DatabaseObject;
use \BlazePHP\Globals as G;
use \BlazePHP\Message as M;
use \BlazePHP\Debug   as D;

/**
 * MySQL Object class handles all entity relations with a specific table
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class MySQLObject extends DatabaseObject
{
	protected $__attributeValues;
	protected $__attributeChecksum;   // Holds a checksum of the original data per attribute
	protected $__attributeList;       // Each attribute requires a type to handle pre and post processing for read/writes
	protected $__attributeDefaults;
	protected $__attributeValidation;
	protected $__attributePack;
	protected $__attributeUnPack;

	//protected static $__dbConnectionName;
	//protected static $__dbTableName;
	//protected static $__idType = BLAZE_OBJECT_ID_AUTO; // BLAZE_OBJECT_ID_TYPE_AUTO || BLAZE_OBJECT_ID_GUID

	protected $__dbMaster;
	protected $__dbSlave;

	protected $__isNew;

	protected $__error;
	protected $__errorMessage;





	/**
	 * Constructor
	 *
	 * @param $id
	 * @param $dbConnection - A master/slave db connection object
	 * @param $dbTableName
	 * @param $attributeList - List of table column mapped attributes Array([column] => [type]....)
	 *
	 */
	public function __construct($id = null, \stdClass $dbConnection = null, $dbTableName = null, $attributeList = null)
	{
		if ($dbConnection === null) {
			if(G::$db->load_data_config === false) {
				throw new \Exception(
					__CLASS__.'::'.__FUNCTION__.' - The Environtment configuration is not set to load any database configuration.'
					.' Set Environment::load_data_config = true; and ensure you have conigured a database connection.'
				);
			}
			$db = G::$db;

			if (!$this::$__dbConnectionName || !isset($db->{$this::$__dbConnectionName})) {
				throw new \Exception(
					__CLASS__.'::'.__FUNCTION__.' - The $dbConnectionName ['.$this::$__dbConnectionName.'] is invalid.'
				);
			}

			$this->__dbMaster =& $db->{$this::$__dbConnectionName}->master;
			$this->__dbSlave  =& $db->{$this::$__dbConnectionName}->slave;
		}
		else {
			$this->__dbMaster      =& $dbConnection->master;
			$this->__dbSlave       =& $dbConnection->slave;
			$this::$__dbTableName   = $dbTableName;
			$this->__attributeList = $attributeList;
		}

		// D::printr($id, false, true);
		if ((integer)$id > 0) {
			// printre('made it');
			$result = $this->__dbSlave->query('SELECT * FROM `'.$this::$__dbTableName.'` WHERE `id`='.$id);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				foreach ($row as $attribute => $value) {
					$this->__attributeChecksum[$attribute] = md5($value);
					$this->__attributeValues[$attribute] = self::unpackValue($value, $this->__attributeList[$attribute]);
				}
				$this->__isNew = false;
			}
			else {
				$this->__error = true;
				$this->__errorMessage = 'No record found by the given ID ('.$id.')';

				throw new \Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,' - '.$this->__errorMessage
				)));
			}

			// Handle any of the custom unpacking
			self::customPacking('out');
		}
		else {
			foreach ($this->__attributeList as $attribute => $type) {
				$this->__attributeValues[$attribute] = self::unpackValue(
					 ($this->__attributeDefaults[$attribute] !== null) ? base64_decode($this->__attributeDefaults[$attribute]) : null
					,$this->__attributeList[$attribute]
				);
			}
			$this->__isNew = true;
		}
	}





	/**
	 * Returns the database connection information needed for the MySQLObjectManager
	 *
	 * @return stdClass
	 */
	public function getManagerInfo()
	{
		$info = new \stdClass();
		$info->dbConnectionName = $this::$__dbConnectionName;
		$info->dbTableName      = $this::$__dbTableName;
		return $info;
	}





	/**
	 * Wrapper to return the database connection information.
	 *
	 * @return string - Database connection name
	 */
	public function getDbConnectionName()
	{
		return $this::$__dbConnectionName;
	}





	/**
	 * Returns the table name for the object being managed
	 *
	 * @return string
	 */
	public function getDbTableName()
	{
		return $this::$__dbTableName;
	}





	/**
	 * Returns the master database connection for the managed object
	 *
	 * @return object
	 */
	public function getDbMaster()
	{
		return $this->__dbMaster;
	}





	/**
	 * Returns the slave database connection for the managed object
	 *
	 * @return object
	 */
	public function getDbSlave()
	{
		return $this->__dbSlave;
	}



	/**
	 * Returns the value of __isNew
	 */
	public function isNew()
	{
		return $this->__isNew;
	}





	/**
	 * Populate an object with provided data (usually from a manager)
	 *
	 * @param $object      - stdClass (or other) object that will be used to populate this object's attributes
	 * @param $setChecksum - True will set the object checksum for save() comparrison, False omits
	 * @return boolean     - True on Success, False on Failure
	 */
	public function populate($object, $setChecksum=false)
	{
		$verdict = false;
		if ($object) {
			$objectAttributes = get_object_vars($object);
			//$validAttributes = array_diff(array_keys($this->__attributeList), array('id'));
			$validAttributes = array_keys($this->__attributeList);

			foreach ($objectAttributes as $name => $value) {
				if (in_array($name, $validAttributes)) {
					$this->{$name} = self::unpackValue($value, $this->__attributeList[$name]);

					if($setChecksum === true) {
						$this->__attributeChecksum[$name] = md5($value);
					}
				}
				else {
					// TODO: Perhaps log warning here?
				}
			}

			$verdict = true;

			if(!empty($this->id)) {
				$this->__isNew = false;
			}
		}

		return $verdict;
	}





	/**
	 * Runs the validation checks if they are specified
	 *
	 * @return Array of errors, empty Array if successful
	 */
	public function validate()
	{
		if(!is_array($this->__attributeValues) || count($this->__attributeValues) <= 0) {
			return array();
		}

		$errors = array();

		foreach($this->__attributeValues as $attribute => $value) {
			if(isset($this->__attributeValidation[$attribute])) {
				foreach($this->__attributeValidation[$attribute] as $validator) {

					list($class, $method) = explode('::', $validator);

					$missingMethod = false;
					if($class === 'self' && !method_exists($this, $method)) {
						$missingMethod = true;
					}
					else if($class !== 'self' && (!class_exists($class) || !method_exists($class, $method))) {
						$missingMethod = true;
					}

					if($missingMethod === true) {
						throw new \Exception(
							__CLASS__.'::'.__FUNCTION__.' - The validation method does not exist ['.$validator.']'
						);
					}

					if($class === 'self') {
						$check = $this->$method($value, $attribute);
					}
					else {
						$check = $class::$method($value, $attribute);
					}

					if($check !== true) {
						$errors[$attribute][] = $check;
					}
				}
			}
		}

		return $errors;
	}





	/**
	 * Processes any of the custom attribute packing/unpacking methods
	 *
	 * @param $direction - 'in' [pack] or 'out' [unpack]
	 * @return void
	 */
	public function customPacking($direction='in')
	{
		if($direction === 'in') {
			$methodBank =& $this->__attributePack;
		}
		else if ($direction === 'out') {
			$methodBank =& $this->__attributeUnPack;
		}

		if(!is_array($methodBank) || count($methodBank) <= 0) {
			return; // do nothing if there are none set
		}

		foreach($this->__attributeValues as $attribute => $value) {
			if(isset($methodBank[$attribute])) {
				foreach($methodBank[$attribute] as $packer) {

					list($class, $method) = explode('::', $packer);

					$missingMethod = false;
					if($class === 'self' && !method_exists($this, $method)) {
						$missingMethod = true;
					}
					else if($class !== 'self' && (!class_exists($class) || !method_exists($class, $method))) {
						$missingMethod = true;
					}

					if($missingMethod === true) {
						throw new \Exception(
							__CLASS__.'::'.__FUNCTION__.' - The custom unpacking method does not exist ['.$packer.']'
						);
					}

					if($class === 'self') {
						$this->__attributeValues[$attribute] = $this->$method($value, $attribute);
					}
					else {
						$this->__attributeValues[$attribute] = $class::$method($value, $attribute);
					}
				}
			}
		}

		return;
	}





	/**
	 * Checks to see if a given attribute value is unique
	 *
	 * @param $value - The value to check
	 * @param $attribute - The name of the attribute
	 * @param $htmlSafe - True sets the return encoded using htmlentities(), False omits
	 * @return mixed - True on no match, "{$value} already exists" on match
	 */
	public function isUnique($value, $attribute, $htmlSafe=true)
	{
		if(!$this->isAttribute($attribute)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The attribute provided is not valid ['.$attribute.']'
			);
		}
		$valuePacked = $this->packValue($value, $this->__attributeList[$attribute], true);

		$sql = array();
		$sql[] = 'SELECT';
		$sql[] = '  1';
		$sql[] = 'FROM';
		$sql[] = '      `'.$this::$__dbTableName.'`';
		$sql[] = 'WHERE';
		$sql[] = '     `'.$attribute.'` = '.$valuePacked;
		if(!$this->__isNew) {
			$sql[] = ' AND `id` != '.(string)(integer)$this->__attributeValues['id'];
		}
		$result = $this->__dbSlave->query(implode(' ', $sql));

		if(false === $result) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - '.$this->__dbMaster->error
			);
		}

		if($result->num_rows == 0) {
			return true;
		}

		return ($htmlSafe === true)
			? htmlentities($value).' already exists'
			: $value.' already exists';

	}





	/**
	 * Checks to see if a given attribute is valid.
	 *
	 * @param $attribute - Name of the attribute to check
	 * @return boolean - True on Success, False on Failure
	 */
	public function isAttribute($attribute)
	{
		return isset($this->__attributeList[$attribute]);
	}





	/**
	 * Retrieves the values for each of the attributes held within the object
	 *
	 * @return object - Returns a stdClass object
	 */
	public function getValues()
	{
		if(!is_array($this->__attributeValues) || count($this->__attributeValues) <= 0) {
			return new \stdClass();
		}
		$values = new \stdClass();
		foreach($this->__attributeValues as $key => $value) {
			$values->{$key} = $value;
		}

		return $values;
	}





	/**
	 * Save the object record to the database
	 *
	 * @return boolean - True on Success, False on Failure
	 */
	public function save($debug=false)
	{


		if ($this->__error === true) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - '.$this->__errorMessage
			);
		}

		// handle any custom packing
		self::customPacking('in');

		$set = array();

		$newChecksumValues = array();

		foreach ($this->__attributeList as $attribute => $type) {

			$value = $this->__attributeValues[$attribute];

			// Check to see what values have changed.  If this is a new record, only set the values that are not empty;
			if ($this->__isNew === true) {

				if (!empty($this->__attributeValues[$attribute]) || strlen($this->__attributeValues[$attribute]) > 0) {
					$set[] = '`'.$attribute.'`='.self::packValue($value, $type);
				}
				else if ($attribute == 'time_created') {
					$set[] = '`time_created`=NOW()';
				}
				else if ($attribute == 'time_modified') {
					$set[] = '`time_modified`=NOW()';
				}
			}
			else {
				$md5 = md5(
					self::packValue($this->__attributeValues[$attribute], $this->__attributeList[$attribute], false)
				);

				if ($attribute == 'time_modified') {
					$set[] = '`time_modified`=NOW()';
				}
				else if ($attribute == 'time_created') {
					continue;
				}
				else if ($md5 != $this->__attributeChecksum[$attribute]) {
					$set[] = '`'.$attribute.'`='.self::packValue($value, $type);
					$newChecksumValues[$attribute] = $md5;
				}
			}
		}

		if($this->__isNew === true && $this::$__idType === BLAZE_OBJECT_ID_GUID) {
			array_unshift($set, '`id`='.Toolbox::makeGUID($this->__dbMaster->nodeID));
		}




		if (($this->__isNew === true && count($set) > 0) || (count($newChecksumValues) > 0 && count($set) > 0)) {
			if ($this->__isNew === true) {
				$sql = 'INSERT INTO `'.$this::$__dbTableName.'` SET '.implode(', ', $set);
			}
			else {
				$sql = 'UPDATE `'.$this::$__dbTableName.'` SET '.implode(', ', $set).' WHERE `id`='.$this->id;
			}

			if (false === $this->__dbMaster->query($sql)) {
				throw new \Exception(
					__CLASS__.'::'.__FUNCTION__.' - '.$this->__dbMaster->error
				);
			}

			$message = 'SQL: '.$sql;
			M::send($message, M::LEVEL_3, M::ADD_NEW_LINE);

			// // After saving the record, update the attribute checksums
			foreach ($newChecksumValues as $attribute => $md5) {
				$this->__attributeChecksum[$attribute] = $md5;
			}

			// Assign the ID field if it was auto generated by the database
			if ($this->__isNew && empty($this->__attributeValues['id'])) {
				$this->__attributeValues['id'] = $this->__dbMaster->getInsertId();
			}

			// This object is no longer new
			$this->__isNew = false;

			// $this->populate($this->getValues());

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
		if(!$this->id) {
			return true;
		}

		$sql = 'DELETE FROM `'.$this::$__dbTableName.'` WHERE `id` = '.$this->id;

		if (false === $this->__dbMaster->query($sql)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - '.$this->__dbMaster->error
			);
		}

		$this->clear();

		return true;
	}






	/**
	 * Pack a value up for a checksum comparrison or for an SQL statement (default)
	 *
	 * @param $value  - value to pack
	 * @param $type   - Data type [string, integer, object]
	 * @param $forSQL - Boolean, true for SQL, false for checksum
	 * @return mixed  - Packed for storage value
	 */
	protected function packValue($value, $type, $forSQL = true)
	{
		if($value === null && $forSQL === true) {
			return 'NULL';
		}
		else if($value === null) {
			return null;
		}
		else if ($type == 'string') {
			if ($forSQL) {
				return '\''.$this->__dbMaster->escape($value).'\'';
			}
			return $value;
		}
		else if ($type == 'integer_as_string') {
			return $value; // Used for large numeric ids, beyond what PHP can store
		}
		else if ($type == 'integer') {
			return (integer)$value;
		}
		else if ($type == 'double') {
			return (double)$value;
		}
		else if ($type == 'float') {
			return (float)$value;
		}
		else if ($type == 'boolean') {
			return (boolean)$value;
		}
		else if ($type == 'array_as_csv') {
			return implode(',', $value);
		}
		else if ($type == 'object' && !empty($value)) {
			if ($forSQL) {
				return '\''.$this->__dbMaster->escape(json_encode($value)).'\'';
			}
			else {
				return json_encode($value);
			}
		}
		else if ($type == 'set') {
			if(is_array($value)) {
				$value = implode(',', $value);
			}

			if($forSQL) {
				return '\''.$this->__dbMaster->escape($value).'\'';
			}
			return $value;
		}
		else if ($type == 'timestamp' || $type == 'datetime') {
			//printr(get_class($value));
			if(gettype($value) != 'object' || get_class($value) != 'DateTime') {
				$value = new \DateTime((string)$value);
			}
			$value->setTimezone(new \DateTimezone('UTC'));
			$return = '\''.$value->format('Y-m-d H:i:s').'\'';
			$value->setTimezone(new \DateTimezone(date_default_timezone_get()));
			return $return;
		}

		throw new \ErrorException('MySQLObject: The type for this value is not recognized ['.$type.'].');
	}





	/**
	 * Unpack a value retreived from the database
	 *
	 * @param $value - Value to be unpacked
	 * @param $type  - Data type [string, integer, object]
	 * @return mixed - Unpacked from storage value
	 */
	protected function unpackValue($value, $type)
	{
		if ($type == 'object') {
			if($value === null) {
				// return new \stdClass();
				return null;
			}
			return json_decode($value);
		}
		else if ($type == 'boolean') {
			return (boolean)$value;
		}
		else if ($type == 'array_as_csv') {
			if (empty($value)) {
				return array();
			}
			return explode(',', $value);
		}
		else if (($type == 'timestamp' || $type == 'datetime') && !empty($value)) {
			$return = new \DateTime($value, new \DateTimeZone("UTC"));
			$return->setTimezone(new \DateTimezone(date_default_timezone_get()));
			return $return;
		}
		else if ($type == 'set') {
			if(empty($value)) {
				return array();
			}
			return explode(',', $value);
		}

		return $value;
	}



	/**
	 * Magical __isset - Allows the use of emtpy() to check for the value of a magic method retrieval
	 *
	 * @param $attribute - Attribute name to retrieve
	 * @return boolean - True if the attribute is set, false otherwise
	 */
	public function __isset($attribute)
	{
		if (!isset($this->__attributeList[$attribute])) {
			return false;
		}
		return true;
	}



	/**
	 * Magical __get - Handles the retrieval of the object attributes;  When in cluster mode,
	 *                 this method compiles the 'id' value to include the prefixed nodeID
	 *
	 * @param $attribute - Attribute name to retrieve
	 * @return mixed - The value of the named attirbute
	 */
	public function __get($attribute)
	{
		if (!isset($this->__attributeList[$attribute])) {
			throw new \ErrorException('MySQLObject Error: Trying to access an invalid attribute ['.$attribute.']');
		}
		if (isset($this->__attributeValues[$attribute])) {
			return $this->__attributeValues[$attribute];
		}
	}





	/**
	 * Magical __set
	 *
	 * @param $attribute
	 * @param $value
	 */
	public function __set($attribute, $value)
	{
		if (!isset($this->__attributeList[$attribute])) {
			throw new \ErrorException('MySQLObject Error: Trying to set an invalid attribute ['.$attribute.']');
		}
		$this->__attributeValues[$attribute] = $value;

		return true;
	}






	/**
	 * Clears all attribute data
	 *
	 * @return void
	 */
	public function clear()
	{
		foreach($this->__attributeValues as $attribute => $type) {
			$this->__attributeValues[$attribute] = null;
			$md5null = md5(null);
			$this->__attributeChecksum[$attribute] = $md5null;
		}
	}





	/**
	 * Returns the ID of an object for storage on a cluster/farm by
	 * concatenating the nodeID onto the beginning of the GUID.
	 *
	 * @return string
	 */
	public function getClusterID()
	{
		if (!empty($this->__attributeValues['id'])) {
			return (string)$this->__dbMaster->nodeID.(string)$this->__attributeValues['id'];
		}
		else {
			return false;
		}
	}





	/**
	 * Returns the ID - This always returns the "id" column.  The MySQLObjectMultiPrimary
	 *                  returns an array holding each of the primary key fields.
	 *
	 *                  This method is used to set the keys on an object list in the
	 *                  MySQLObjectManager class.
	 *
	 * @return array
	 */
	public function id()
	{
		return array('id');
	}










































}
