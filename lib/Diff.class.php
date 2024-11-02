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
 * Diff
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Diff extends Struct
{
	private $tempFile;

	public function __construct($fileLocOne, $fileLocTwo)
	{
		if(!file_exists($fileLocOne)) {
			throw new Exception( implode(' ', array(
				__CLASS__.'::'.__FUNCTION__
				,'['.$fileLocOne.'] does not exist'
			)));
		}
		if(!file_exists($fileLocTwo)) {
			throw new Exception( implode(' ', array(
				__CLASS__.'::'.__FUNCTION__
				,'['.$fileLocTwo.'] does not exist'
			)));
		}

		$tempFileName = 'sys.'.__CLASS__.'.'.__FUNCTION__;
		$this->tempFile = new \BlazePHP\Temp($tempFileName, null);

		exec('/usr/bin/env diff '.$fileLocOne.' '.$fileLocTwo, $output);
		$this->tempFile->write(implode("\n", $output));
	}

	public function read($linePrefix=null)
	{
		return $this->tempFile->read($linePrefix);
	}
}
