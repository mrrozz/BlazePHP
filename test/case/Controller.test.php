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
use \BlazePHP\Debug      as D;
use BlazeTest\TestCase;

class TestController extends C
{
	public function setVar()
	{
		$this->a = 'a';
		return true;
	}

	public function getVar()
	{
		return $this->a;
	}

	public function validateLayout()
	{
		$this->setLayout('custom');
		$this->layoutName = 'CUSTOM';
	}
}

define('MODULE_ROOT', dirname(__DIR__).'/case/Controller');

final class ControllerTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(TestController::class, new TestController());
	}

	public function testBeforeMethod()
	{
		$controller = new TestController();
		$this->assertNull($controller->before());
	}

	public function testAfterMethod()
	{
		$controller = new TestController();
		$this->assertNull($controller->after());
	}

	public function testSetVar()
	{
		$controller = new TestController();
		$controller->before();
		$success = $controller->setVar();
		$controller->after();

		$this->assertTrue($success);
	}

	public function testGetVar()
	{
		$controller = new TestController();
		$controller->before();
		$controller->setVar();
		$value = $controller->getVar();
		$controller->after();

		$this->assertValueEquals('a', $value);
	}

	public function testCustomLayout()
	{
		$defaultLayoutLoc = \BlazePHP\ControllerValues::$layout;

		$controller = new TestController();
		$controller->before();
		$controller->validateLayout();
		$controller->after();

		$customLayoutLoc = \BlazePHP\ControllerValues::$layout;

		$this->assertNotEmpty($customLayoutLoc);
		$this->assertFileExists($customLayoutLoc);
	}

	public function testRenderReturn()
	{
		$controller = new TestController();
		$controller->before();
		$controller->after();

		ob_start();
		$content  = $controller->renderReturn();
		$rendered = ob_get_contents();

		$this->assertValueEquals('DEFAULT LAYOUT', trim($content));
		$this->assertEmpty($rendered);
	}

	public function testRender()
	{
		$controller = new TestController();
		$controller->before();
		$controller->after();

		ob_start();
		$content  = $controller->render();
		$rendered = ob_get_contents();

		$this->assertValueEquals('DEFAULT LAYOUT', trim($rendered));
		$this->assertTrue($content);
	}

	public function testRenderCustomLayout()
	{
		$controller = new TestController();
		$controller->before();
		$controller->validateLayout();
		$controller->after();

		$content = $controller->renderReturn();

		$this->assertValueEquals('CUSTOM LAYOUT', trim($content));
	}

}
