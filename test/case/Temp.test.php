<?php
namespace BlazeTest;

use BlazeTest\TestCase;


final class TempTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Temp::class, new \BlazePHP\Temp(__CLASS__));
	}

	public function testTempFileLocation()
	{
		$temp = new \BlazePHP\Temp(__CLASS__);
		$this->assertNotEmpty($temp->fileLocation());
	}

	public function testTempFileExists()
	{
		$temp = new \BlazePHP\Temp(__CLASS__);
		$this->assertFileExists($temp->fileLocation());
	}

	public function testTempFileWriteable()
	{
		$temp = new \BlazePHP\Temp(__CLASS__);
		$this->assertFileWriteable($temp->fileLocation());
	}

	public function testTempFileReadable()
	{
		$temp = new \BlazePHP\Temp(__CLASS__);
		$this->assertFileReadable($temp->fileLocation());
	}

	public function testTempFileEntry()
	{
		$string = 'TEST TEMP ENTRY ['.md5(microtime(true)).']';
		$temp = new \BlazePHP\Temp(__CLASS__, $string);
		$this->assertStringFoundInFile($string, $temp->fileLocation());
	}

	public function testTempFileCleanup()
	{
		$temp = new \BlazePHP\Temp(__CLASS__);
		$fileLocation = $temp->fileLocation();
		unset($temp);
		$this->assertFileDoesNotExist($fileLocation);
	}
}
