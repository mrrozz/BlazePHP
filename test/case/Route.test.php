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
// use \BlazePHP\Route   as R;
use \BlazePHP\Request;
use \BlazePHP\Struct;
use BlazeTest\TestCase;

$_REQUEST['__requested_path'] = 'myController/myAction/id:202/list:34/order:asc';
G::$request = new Request();

class Route extends \BlazePHP\Route
{
	public function __construct()
	{
		// %i - the argument is treated as an unsigned integer
		// %s - the argument is treated as and presented as a string matching the following pattern '[a-zA-Z0-9_\-\.]'.

		$this->alias('/mycontroller/myaction/id:$i1', '/myAlias/%i');
		$this->alias('/mycontroller/myaction/id:$i1/form:$i2', '/myAlias/%i/%i');

		parent::__construct();
	}
}


final class RouteTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(Route::class, new Route());
	}

	public function testGetController()
	{
		$route = new Route();
		$this->assertTrue('mycontroller' === $route->getController());
	}

	public function testGetAction()
	{
		$route = new Route();
		$this->assertTrue('myaction' === $route->getAction());
	}

	public function testGetParameters()
	{
		$route = new Route();
		$parameters = $route->getParameters();
		$this->assertArray($parameters);
		$this->assertArrayNotEmpty($parameters);
		$this->assertTrue((integer)$parameters['id'] === 202);
		$this->assertTrue((integer)$parameters['list'] === 34);
		$this->assertTrue($parameters['order'] === 'asc');
	}

	public function testTranslate()
	{
		$_REQUEST['__requested_path'] = 'myAlias/202';
		G::$request = new Request();
		$route      = new Route();

		$this->assertTrue('mycontroller' === $route->getController());
		$this->assertTrue('myaction' === $route->getAction());
		$parameters = $route->getParameters();
		$this->assertArray($parameters);
		$this->assertArrayNotEmpty($parameters);
		$this->assertTrue((integer)$parameters['id'] === 202);
	}
}
