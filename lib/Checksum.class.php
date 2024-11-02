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
namespace BlazePHP;


/**
 * Checksum
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Checksum extends Struct
{

 	private $checksumLoc;
	public $lastChecksum;
	private $logChecksum = false;
	public $checksum;

	public function __construct($name, $checksum)
	{

		$this->checksum = $checksum;

		$this->checksumLoc = implode('/', array(ABS_VAR, 'checksum', $name.'.checksum'));

		$this->lastChecksum = null;
		if(file_exists($this->checksumLoc)) {
			$lastChecksum = file($this->checksumLoc);
			$this->lastChecksum = trim($lastChecksum[0]);
		}
	}


	public function __destruct()
	{
		if($this->logChecksum === true) {
			$checksumHandle = fopen($this->checksumLoc, 'w');
			fwrite($checksumHandle, $this->checksum);
			fclose($checksumHandle);
		}
	}


	public function success()
	{
		$this->logChecksum = true;
	}


	public function fail()
	{
		$this->logChecksum = false;
	}


	public function last()
	{
		return $this->lastChecksum;
	}

	public function fileLocation()
	{
		return $this->checksumLoc;
	}
}
