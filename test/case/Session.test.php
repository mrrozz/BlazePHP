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
use \BlazePHP\Debug   as D;
use BlazeTest\TestCase;


final class SessionTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(S::class, new S());
	}

	public function testSetVariable()
	{
		$session = new S();
		$session->test = 'test';
		$this->assertValueEquals($session->test, 'test');
	}

	public function testGetVariable()
	{
		$session = new S();
		$this->assertValueEquals($session->test, 'test');
	}

	public function testGetURLToken()
	{
		$session = new S();
		$urlToken = $session->URLToken();
		$match = preg_match('/PHPSESSID\=[a-z0-9]+$/', $urlToken);
		$this->assertValueEquals(1, $match);
	}

}
