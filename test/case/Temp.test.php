<?php
namespace BlazeTest;
use BlazePHP\Temp;
use BlazeTest\TestCase;


final class TempTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(Temp::class, new Temp(__CLASS__));
	}

	public function testTempFileLocation()
	{
		$temp = new Temp(__CLASS__);
		$this->assertNotEmpty($temp->fileLocation());
	}

	public function testTempFileExists()
	{
		$temp = new Temp(__CLASS__);
		$this->assertFileExists($temp->fileLocation());
	}

	public function testTempFileWriteable()
	{
		$temp = new Temp(__CLASS__);
		$this->assertFileWriteable($temp->fileLocation());
	}

	public function testTempFileReadable()
	{
		$temp = new Temp(__CLASS__);
		$this->assertFileReadable($temp->fileLocation());
	}

	public function testTempFileEntry()
	{
		$string = 'TEST TEMP ENTRY ['.md5(microtime(true)).']';
		$temp = new Temp(__CLASS__, $string);
		$this->assertStringFoundInFile($string, $temp->fileLocation());
	}

	public function testTempFileCleanup()
	{
		$temp = new Temp(__CLASS__);
		$fileLocation = $temp->fileLocation();
		unset($temp);
		$this->assertFileDoesNotExist($fileLocation);
	}
}
