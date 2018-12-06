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
use BlazePHP\Lock;
use BlazeTest\TestCase;
use BlazePHP\Debug as D;


final class LockTest extends TestCase
{
	public function testLock()
	{
		$lock = new Lock('test');
		$this->expectException(\Exception::class);
		$lock2 = new Lock('test');
	}

	public function testInstanceCreates()
	{
		$lock = new Lock(__CLASS__);
		$this->assertInstanceOf(Lock::class, $lock);
		unset($lock);
	}

	public function testLogFileLocation()
	{
		$lock = new Lock(__CLASS__);
		$this->assertNotEmpty($lock->fileLocation());
		unset($lock);
	}
	//
	public function testLogFileExists()
	{
		$lock = new Lock(__CLASS__);
		$this->assertFileExists($lock->fileLocation());
		unset($lock);
	}

	public function testLogFileWriteable()
	{
		$lock = new Lock(__CLASS__);
		$this->assertFileWriteable($lock->fileLocation());
		unset($lock);
	}

	public function testLogFileReadable()
	{
		$lock = new Lock(__CLASS__);
		$this->assertFileReadable($lock->fileLocation());
		unset($lock);
	}

	public function testLockEnabled()
	{
		$lock  = new Lock(__CLASS__);
		$this->expectException(\Exception::class);
		$lock2 = new Lock(__CLASS__);
	}

}
