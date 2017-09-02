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
