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
 * @package       Blaze.
 */
namespace BlazeTest;
use BlazePHP\Log;
use BlazeTest\TestCase;


final class LogTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(Log::class, new Log(__CLASS__, 1));
	}

	public function testLogFileLocation()
	{
		$log = new Log(__CLASS__, 1);
		$this->assertNotEmpty($log->fileLocation());
	}

	public function testLogFileExists()
	{
		$log = new Log(__CLASS__, 1);
		$this->assertFileExists($log->fileLocation());
	}

	public function testLogFileWriteable()
	{
		$log = new Log(__CLASS__, 1);
		$this->assertFileWriteable($log->fileLocation());
	}

	public function testLogFileReadable()
	{
		$log = new Log(__CLASS__, 1);
		$this->assertFileReadable($log->fileLocation());
	}

	public function testLogFileEntry()
	{
		$log = new Log(__CLASS__, 1);
		$string = 'TEST LOG ENTRY ['.md5(microtime(true)).']';
		$log->write(1, $string, true /* add new line */);
		$this->assertStringFoundInFile($string, $log->fileLocation());
	}
}
