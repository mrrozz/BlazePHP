<?php
namespace BlazeTest;

use BlazeTest\TestCase;


final class LogTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Log::class, new \BlazePHP\Log(__CLASS__, 1));
	}

	public function testLogFileLocation()
	{
		$log = new \BlazePHP\Log(__CLASS__, 1);
		$this->assertNotEmpty($log->fileLocation());
	}

	public function testLogFileExists()
	{
		$log = new \BlazePHP\Log(__CLASS__, 1);
		$this->assertFileExists($log->fileLocation());
	}

	public function testLogFileWriteable()
	{
		$log = new \BlazePHP\Log(__CLASS__, 1);
		$this->assertFileWriteable($log->fileLocation());
	}

	public function testLogFileReadable()
	{
		$log = new \BlazePHP\Log(__CLASS__, 1);
		$this->assertFileReadable($log->fileLocation());
	}

	public function testLogFileEntry()
	{
		$log = new \BlazePHP\Log(__CLASS__, 1);
		$string = 'TEST LOG ENTRY ['.md5(microtime(true)).']';
		$log->write(1, $string, true /* add new line */);
		$this->assertStringFoundInFile($string, $log->fileLocation());
	}
}
