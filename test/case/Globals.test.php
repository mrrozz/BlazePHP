<?php
namespace BlazeTest;
use \BlazePHP\Globals as G;
use BlazeTest\TestCase;


final class GlobalsTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(G::class, new G());
	}

	public function testExceptionOnUndefinedPropertySet()
	{
		$this->expectException(\ErrorException::class);

		$G = new G();
		$G->testingBadVar = 'test'; // Invalid global variable
	}


	public function testExceptionOnUndefinedPropertyGet()
	{
		$this->expectException(\ErrorException::class);

		$G = new G();
		echo $G->testingBadVar; // Invalid global variable
	}
}
