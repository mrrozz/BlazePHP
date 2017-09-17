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
use \BlazePHP\Globals as G;
use \BlazePHP\Struct;

/**
 * MySQL Object Manager class handles all collections of MySQL objects.
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class MySQLObjectManager
{
	protected $objectName;

	protected $dbMaster;
	protected $dbSlave;
	protected $dbTableName;


	public function __construct()
	{
		if (!class_exists($this->objectName)) {
			throw new \ErrorException(
				__CLASS__ . '::' . __FUNCTION__ . ' - The object ['.$this->objectName.'] is missing or does not exist.'
			);
		}

		$obj    = new $this->objectName;
		//printre($obj::$__dbConnectionName);
		$dbInfo = $obj->getManagerInfo();

		$this->dbMaster    =& G::$db->{$dbInfo->dbConnectionName}->master;
		$this->dbSlave     =& G::$db->{$dbInfo->dbConnectionName}->slave;
		$this->dbTableName = $dbInfo->dbTableName;
	}





	public function getCount(ManagerListOptions $mlo)
	{
		$sql = array();
		$sql = array();
		$sql[] = 'SELECT';
		$sql[] = '  COUNT(1) AS `totalCount`';
		$sql[] = 'FROM';
		$sql[] = '      `'.$this->dbTableName.'`';
		$sql[] = ($mlo->conditions !== null) ? $mlo->conditions  : '';
		if($mlo->dumpSQL) {
			printre(implode("\n", $sql));
		}

		try {
			$row = $this->dbSlave->query(implode(' ', $sql))->fetch_object();
		}
		catch(Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - SQL Error: '.$e->getMessage()
			)));
		}

		return (isset($row->totalCount)) ? (integer)$row->totalCount : 0;
	}





	protected function _list($type = 'data', $fields = '*', $start=0, $count=null, $conditions = null, $dumpSQL=false)
	{
		// primary key fields
		$object    = new $this->objectName();
		$pkFields  = $object->id();

		$sql   = array();
		$sql[] = 'SELECT';
		if($fields === '*') {
			$sql[] = '*';
		}
		else {
			if (!is_array($fields)) {
				$fields = array($fields);
			}
			$sql[] = '`'.implode('`, `', array_merge($pkFields, $fields)).'`';
		}
		$sql[] = 'FROM';
		$sql[] = $this->dbTableName;
		$sql[] = ($conditions !== null) ? $conditions  : '';
		if(!is_null($count) && (integer)$count > 0) {
			$sql[] = 'LIMIT';
			$sql[] = (string)(integer)$start.', '.(string)$count;
		}
		if($dumpSQL === true) {
			printre(implode("\n", $sql));
		}

		try {
			$results = $this->dbSlave->query(implode(' ', $sql));
		}
		catch(Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - SQL Error: '.$e->getMessage()
			)));
		}
		$list      = array();
		while($row = $results->fetch_object()) {

			// Build the ID key
			$id = '';
			foreach($pkFields as $column) {
				$id .= (string)$row->{$column};
			}

			if($type === 'object') {
				$list[$id] = new $this->objectName;
				$list[$id]->populate($row, true);
			}
			else if ($type === 'data') {
				$list[$id] = $row;
			}
			else if ($type === 'html') {
				$objAsArray = get_object_vars($row);
				foreach($objAsArray as $key => $value) {
					$row->{$key} = htmlentities($value);
				}
				$list[$id] = $row;
			}
		}

		return $list;
	}





	public function listFullObject(ManagerListOptions $mlo)
	{
		return $this->_list('object', $mlo->fields, $mlo->start, $mlo->count, $mlo->conditions, $mlo->dumpSQL);
	}


	public function listData(ManagerListOptions $mlo)
	{
		return $this->_list('data', $mlo->fields, $mlo->start, $mlo->count, $mlo->conditions, $mlo->dumpSQL);
	}


	public function listDataHTML(ManagerListOptions $mlo)
	{
		return $this->_list('html', $mlo->fields, $mlo->start, $mlo->count, $mlo->conditions, $mlo->dumpSQL);
	}


	public function firstFullObject(ManagerListOptions $mlo)
	{
		$mlo->count = 1;
		$list = $this->listFullObject($mlo);
		if(count($list) <= 0) {
			return null;
		}
		return array_shift($list);
	}


	public function firstData(ManagerListOptions $mlo)
	{
		$mlo->count = 1;
		$list = $this->listData($mlo);
		if(count($list) <= 0) {
			return null;
		}
		return array_shift($list);
	}


	public function firstDataHTML(ManagerListOptions $mlo)
	{
		$mlo->count = 1;
		$list = $this->listDataHTML($mlo);
		if(count($list) <= 0) {
			return null;
		}
		return array_shift($list);
	}


	public function escape($string)
	{
		return $this->dbMaster->escape($string);
	}

	public static function makeMLO()
	{
		return new ManagerListOptions();
	}
}




class ManagerListOptions extends Struct
{
	public $start      = 0;
	public $count      = null; // Return all records
	public $fields     = '*';
	public $omitFields = null;
	public $conditions = null;
	public $dumpSQL    = false;
}
