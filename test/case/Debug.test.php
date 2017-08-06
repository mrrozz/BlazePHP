<?php
namespace BlazeTest;
use \BlazePHP\Debug;
use BlazeTest\TestCase;

final class DebugTest extends TestCase
{

	public function testInstanceCreates()
	{
		$this->assertInstanceOf(Debug::class, new Debug(__CLASS__, md5(time())));
	}

}
