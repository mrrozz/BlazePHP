<?php
namespace BlazeTest;
use \BlazePHP\Controller as C;
use \BlazePHP\Struct;
use BlazeTest\TestCase;

class TestController extends C
{
	// The Controller class is abstract
}

final class ControllerTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(TestController::class, new TestController());
	}
}
