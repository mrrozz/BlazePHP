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
use \BlazePHP\ControllerAPI as CAPI;
use \BlazePHP\Struct;
use \BlazePHP\Debug         as D;
use BlazeTest\TestCase;

class TestControllerAPI extends CAPI
{
	// The Controller class is abstract
}

final class ControllerAPITest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(TestControllerAPI::class, new TestControllerAPI());
	}

	public function testBeforeMethod()
	{
		$controller = new TestControllerAPI();
		$this->assertNull($controller->before());
	}

	public function testAfterMethod()
	{
		$controller = new TestControllerAPI();
		$this->assertNull($controller->after());
	}
}
