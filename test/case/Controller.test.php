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
