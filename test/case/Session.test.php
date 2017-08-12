<?php
namespace BlazeTest;
use \BlazePHP\Session as S;
use \BlazePHP\SessionConfig;
use \BlazePHP\Struct;
use BlazeTest\TestCase;


final class SessionTest extends TestCase
{
	public function testInstanceCreates()
	{
		$conf = new SessionConfig();
		$this->assertInstanceOf(S::class, new S($conf));
	}

	public function testSetConfig()
	{
		$conf = new SessionConfig();

		$session = new S($conf);
		printre($session);

	}

}
