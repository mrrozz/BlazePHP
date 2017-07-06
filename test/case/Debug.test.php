<?php
namespace BlazeTest;

use BlazeTest\TestCase;

final class DebugTest extends TestCase
{

	public function testInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Debug::class, new \BlazePHP\Debug(__CLASS__, md5(time())));
	}

}
