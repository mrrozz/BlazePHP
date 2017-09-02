<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2017, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2017, BlazePHP.com
 * @link          http://blazePHP.com
 * @package       Blaze.
 */
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
