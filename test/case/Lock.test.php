<?php
namespace BlazeTest;
use BlazePHP\Lock;
use BlazeTest\TestCase;


final class LockTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(Lock::class, new Lock(__CLASS__));
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
