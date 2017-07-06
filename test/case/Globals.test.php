<?php
namespace BlazeTest;

use BlazeTest\TestCase;


final class GlobalsTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Globals::class, new \BlazePHP\Globals());
	}

	public function testExceptionOnUndefinedPropertySet()
	{
		$this->expectException(\ErrorException::class);

		$G = new \G();
		$G->testingBadVar = 'test'; // Invalid global variable
	}


	public function testExceptionOnUndefinedPropertyGet()
	{
		$this->expectException(\ErrorException::class);

		$G = new \G();
		echo $G->testingBadVar; // Invalid global variable
	}
}
