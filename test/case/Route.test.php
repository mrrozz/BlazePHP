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
use \BlazePHP\Debug as D;
use BlazeTest\TestCase;


$_REQUEST['__requested_path'] = 'myController/myAction/id:202/list:34/order:asc';
$_REQUEST['__requested_path'] = '/';
G::$request = new Request();

class _Route extends \BlazePHP\Route
{
	public function __construct()
	{
		// %i - the argument is treated as an unsigned integer
		// %s - the argument is treated as and presented as a string matching the following pattern '[a-zA-Z0-9_\-\.]'.

		// SEO Canonical Testing
		$this->alias('/Public/landing', '/site-home');
		$this->alias('/Public/landing', '/follow-me-home');
		$this->alias('/Public/landing', '/home-is-where-the-heart-is');
		$this->alias('/Public/landing', '/', self::SEO_CANONICAL);

		$this->alias('/Public/articles', '/articles');
		$this->alias('/Public/articles', '/news-and-information', self::SEO_CANONICAL);

		$this->alias('/Public/unsubscribe', '/unsubscribe');

		$this->alias('/mycontroller/myaction',                 '/myController/myAction');
		$this->alias('/mycontroller/myaction/id:$i1',          '/myAlias/%i');
		$this->alias('/mycontroller/myaction/id:$i1/form:$i2', '/myAlias/%i/%i');
		$this->alias('/blog/view/article:$s1',                 '/blog/%s');
		$this->alias('/blog/view/article:$s1/mode:$s2',        '/blog/%s/%s');

		$this->alias('/OrderAPI/setBIStatus/idMD5:$s1/lineId:$i1/status:$s2'
		                                                           ,'/order/build/status/%s/%i/%s');


		$this->noIndex('/unsubscribe');
		$this->noIndex('/unsubscribe/');
		$this->noIndex('/login');
		$this->noIndex('/login/');

		parent::__construct();
	}
}


final class RouteTest extends TestCase
{

	public function testTestManyStrings()
	{
		$_REQUEST['__requested_path'] = 'order/build/status/c81e728d9d4c2f636f067f89cc14862c/1/completed';
		G::$request = new Request();
		$route      = new _Route();
		$this->assertValueEquals('orderapi', $route->getController());
		$this->assertValueEquals('setbistatus', $route->getAction());
		$parameters = $route->getParameters();
		D::printre($parameters);

	}

	public function testTranslateStrings()
	{
		$_REQUEST['__requested_path'] = 'blog/test-article-name/edit/admin/quick';
		G::$request = new Request();
		$route      = new _Route();
		$this->assertValueEquals('blog', $route->getController());
		$this->assertValueEquals('view', $route->getAction());
		$parameters = $route->getParameters();
		D::printre($parameters);

		$this->assertValueEquals($parameters['article'], 'test-article-name');
		$this->assertValueEquals($parameters['mode'], 'edit');
		$this->assertValueEquals($parameters['admin'], true);
		$this->assertValueEquals($parameters['quick'], true);
	}


	public function testInstanceCreates()
	{
		$this->assertInstanceOf(_Route::class, new _Route());
	}

	public function testGetController()
	{
		$_REQUEST['__requested_path'] = 'myController/myAction/id:202/list:34/order:asc';
		G::$request = new Request();

		$route = new _Route();
		$this->assertTrue('mycontroller' === $route->getController());
	}

	public function testGetAction()
	{
		$_REQUEST['__requested_path'] = 'myController/myAction/id:202/list:34/order:asc';
		G::$request = new Request();

		$route = new _Route();
		$this->assertTrue('myaction' === $route->getAction());
	}

	public function testGetParameters()
	{
		$_REQUEST['__requested_path'] = 'myController/myAction/id:202/list:34/order:asc';
		G::$request = new Request();

		$route = new _Route();
		$parameters = $route->getParameters();
		$this->assertArray($parameters);
		$this->assertArrayNotEmpty($parameters);
		$this->assertTrue((integer)$parameters['id'] === 202);
		$this->assertTrue((integer)$parameters['list'] === 34);
		$this->assertTrue($parameters['order'] === 'asc');
	}

	public function testTranslateIntegers()
	{
		$_REQUEST['__requested_path'] = 'myAlias/202/234';
		G::$request = new Request();
		$route      = new _Route();
		$this->assertTrue('mycontroller' === $route->getController());
		$this->assertTrue('myaction' === $route->getAction());
		$parameters = $route->getParameters();
		$this->assertArray($parameters);
		$this->assertArrayNotEmpty($parameters);
		$this->assertTrue((integer)$parameters['id'] === 202);
		$this->assertTrue((integer)$parameters['form'] === 234);

		$_REQUEST['__requested_path'] = 'myAlias/203';
		G::$request = new Request();
		$route      = new _Route();
		$this->assertTrue('mycontroller' === $route->getController());
		$this->assertTrue('myaction' === $route->getAction());
		$parameters = $route->getParameters();
		$this->assertArray($parameters);
		$this->assertArrayNotEmpty($parameters);
		$this->assertTrue((integer)$parameters['id'] === 203);
	}


	public function testSEOCanonicalNoVariables()
	{
		$_REQUEST['__requested_path'] = '/articles';
		G::$request = new Request();
		$route = new _Route();
		$this->assertTrue('/news-and-information' === $route->getCanonicalPath());

		$_REQUEST['__requested_path'] = '/site-home';
		G::$request = new Request();
		$route = new _Route();
		$this->assertTrue('/' === $route->getCanonicalPath());
	}

	public function testSEONoIndexPath()
	{
		$_REQUEST['__requested_path'] = '/unsubscribe';
		G::$request = new Request();

		$route = new _Route();
		$this->assertTrue(in_array('/unsubscribe',$route->getNoIndexList()));
		$this->assertTrue(in_array('/unsubscribe/',$route->getNoIndexList()));
		$this->assertTrue(in_array('/login',$route->getNoIndexList()));
		$this->assertTrue(in_array('/login/',$route->getNoIndexList()));
	}

}
