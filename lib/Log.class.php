<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2013, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     Copyright 2012 - 2013, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
namespace BlazePHP;


/**
 * Log
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Log
{
	public $fp;
	private $file;
	private $addTimeStamp = true;

	public $level;

	public function __construct($namePrefix, $level)
	{
		$this->level = $level;

		if($this->level <= 0) {
			return;
		}

		// Filter out special chars
		$namePrefix = preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $namePrefix);

		$this->file = ABS_VAR.'/log/'.$namePrefix.'-'.date('Y-m-d').'.log';
		$this->fp = fopen($this->file, 'a');
		if(!$this->fp) {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - There has been an error trying to open the log file ['.$this->file.']'
			);
		}
	}

	public function __destruct()
	{
		if($this->level <= 0) {
			return;
		}

		// Add a closing new-line-feed if the last log entry did not include it
		if($this->addTimeStamp === false) {
			fputs($this->fp, "\n");
		}

		fclose($this->fp);
	}



	public function write($level, $message, $addNewLine=true)
	{
		if($level > $this->level) {
			return;
		}

		if($this->addTimeStamp === true) {
			$message = '['.date('Y-m-d H:i:s').'] '.$message;
			$this->addTimeStamp = false;
		}

		if($addNewLine === true) {
			$message = $message."\n";
			$this->addTimeStamp = true;
		}

		fputs($this->fp, $message);
	}



	public function fileLocation()
	{
		return $this->file;
	}

}
