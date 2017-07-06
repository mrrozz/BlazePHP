<?php
namespace BlazeTest;

use BlazeTest\TestCase;

final class ChecksumTest extends TestCase
{

	public function testInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Checksum::class, new \BlazePHP\Checksum(__CLASS__, md5(time())));
	}

	public function testChecksumFileLocation()
	{
		$checksum = new \BlazePHP\Checksum(__CLASS__, md5(microtime(true)));
		$this->assertNotEmpty($checksum->fileLocation());
	}

	public function testChecksumFileExists()
	{
		$checksum = new \BlazePHP\Checksum(__CLASS__, md5(microtime(true)));
		$this->assertFileExists($checksum->fileLocation());
	}

	public function testChecksumFileWriteable()
	{
		$checksum = new \BlazePHP\Checksum(__CLASS__, md5(microtime(true)));
		$this->assertFileWriteable($checksum->fileLocation());
	}

	public function testChecksumFileReadable()
	{
		$checksum = new \BlazePHP\Checksum(__CLASS__, md5(microtime(true)));
		$this->assertFileReadable($checksum->fileLocation());
	}

	public function testChecksumFailNoWrite()
	{
		$string       = md5(microtime(true));
		$checksum     = new \BlazePHP\Checksum(__CLASS__, $string);
		$fileLocation = $checksum->fileLocation();
		$checksum->fail();
		unset($checksum);
		$this->assertStringNotFoundInFile($string, $fileLocation);
	}

	public function testChecksumSuccessWrite()
	{
		$string       = md5(microtime(true));
		$checksum     = new \BlazePHP\Checksum(__CLASS__, $string);
		$lastChecksum = $checksum->last();
		$fileLocation = $checksum->fileLocation();
		$checksum->success();
		unset($checksum);
		$this->assertStringFoundInFile($string, $fileLocation);
	}
}
