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
 * @license	   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright	 2012 - 2017, BlazePHP.com
 * @link		  http://blazePHP.com
 *
 */
namespace BlazePHP;


/**
 * Diff
 *
 * @author	Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Temp extends Struct
{
	public  $fileLocation;
	public  $noCleanup = false;


	public function __construct($name, $data=null)
	{
		$extention		 = md5(microtime(true));
		$this->fileLocation = implode('/', array(ABS_VAR, 'tmp', $name.'.'.$extention));
		self::write($data);
	}


	public function __destruct()
	{
		if($this->noCleanup !== true) {
			unlink($this->fileLocation);
		}
	}

	public function write($data)
	{
		$fh = fopen($this->fileLocation, 'w');
		fwrite($fh, $data);
		fclose($fh);
	}

	public function read($linePrefix=null)
	{
		if(!file_exists($this->fileLocation)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'- The file ['.$this->fileLocation.'] does not exist'
			)));
		}

		$linesRaw = file($this->fileLocation);
		$lines	  = array();
		foreach($linesRaw as $line) {
			$lines[] = (string)$linePrefix.$line;
		}

		$data = implode('', $lines);

		return $data;
	}

	public function fileLocation()
	{
		return $this->fileLocation;
	}
}
