<?php
namespace BlazeTest;

use BlazeTest\TestCase;


final class LockTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Lock::class, new \BlazePHP\Lock(__CLASS__));
	}

	public function testLogFileLocation()
	{
		$lock = new \BlazePHP\Lock(__CLASS__);
		$this->assertNotEmpty($lock->fileLocation());
		unset($lock);
	}
	//
	public function testLogFileExists()
	{
		$lock = new \BlazePHP\Lock(__CLASS__);
		$this->assertFileExists($lock->fileLocation());
		unset($lock);
	}

	public function testLogFileWriteable()
	{
		$lock = new \BlazePHP\Lock(__CLASS__);
		$this->assertFileWriteable($lock->fileLocation());
		unset($lock);
	}

	public function testLogFileReadable()
	{
		$lock = new \BlazePHP\Lock(__CLASS__);
		$this->assertFileReadable($lock->fileLocation());
		unset($lock);
	}

	public function testLockEnabled()
	{
		$lock  = new \BlazePHP\Lock(__CLASS__);
		$this->expectException(\Exception::class);
		$lock2 = new \BlazePHP\Lock(__CLASS__);
	}

}
