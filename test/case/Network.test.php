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
use \BlazePHP\Network as N;
use BlazeTest\TestCase;


final class NetworkTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(N::class, new N());
	}

	public function testExceptionOnUndefinedPropertySet()
	{
		$this->expectException(\ErrorException::class);

		$N = new N();
		$N->testingBadVar = 'test'; // Invalid global variable
	}


	public function testExceptionOnUndefinedPropertyGet()
	{
		$this->expectException(\ErrorException::class);

		$N = new N();
		echo $N->testingBadVar; // Invalid global variable
	}


	public function testMakePostParameters()
	{
		$parameters = N::makeParameters('POST');

		$this->assertInstanceOf(\BlazePHP\POSTParameters::class, $parameters);
	}


	public function testMakeGetParameters()
	{
		$parameters = N::makeParameters('GET');

		$this->assertInstanceOf(\BlazePHP\GETParameters::class, $parameters);
	}

	public function testGetRequest()
	{
		$p = N::makeParameters('GET');
		$p->URL = 'http://www.cakesucks.com/test.json';

		$response = N::GET($p);
		$this->assertTrue(isset($response['data']));
		$this->assertArray($response['data']);
		$this->assertArrayNotEmpty($response['data']);
		$this->assertTrue((count($response['data']) === 4));
	}

	public function testPostRequest()
	{
		$p = N::makeParameters('POST');
		$p->URL = 'http://www.cakesucks.com/testpost.php';
		$p->postFields = array('testArray' => array(1,2,3,4));

		$response = N::POST($p);
		// printr($response);
		$this->assertTrue(isset($response['data']));
		$this->assertTrue(isset($response['data']->testArray));
		$this->assertArray($response['data']->testArray);
		$this->assertArrayNotEmpty($response['data']->testArray);
		$this->assertTrue((count($response['data']->testArray) === 4));
	}

	// public function testGetMultiRequestBadParameter()
	// {
	// 	$this->expectException(\Exception::class);
	//
	// 	$p1 = N::makeParameters('GET');
	// 	$p1->URL = 'http://www.cakesucks.com/test.json';
	//
	// 	$p2 = N::makeParameters('GET');
	// 	$p2->URL = 'http://www.cakesucks.com/test2.json';
	//
	// 	$p3 = new stdClass();
	// 	$p3->URL = 'http://www.cakesucks.com/test3.json';
	//
	// 	$response = N::GETMulti(array($p1, $p2, $p3));
	// }

	// public function testGetMultiRequest()
	// {
	// 	$p1 = N::makeParameters('GET');
	// 	$p1->URL = 'http://www.cakesucks.com/test.json';
	//
	// 	$p2 = N::makeParameters('GET');
	// 	$p2->URL = 'http://www.cakesucks.com/test2.json';
	//
	// 	$p3 = N::makeParameters('GET');
	// 	$p3->URL = 'http://www.cakesucks.com/test3.json';
	//
	// 	$response = N::GETMulti(array($p1, $p2, $p3));
	//
	// }

	// public function testPostMultiRequestBadParameter()
	// {
	// 	$this->expectException(\Exception::class);
	//
	// 	$p1 = N::makeParameters('POST');
	// 	$p1->URL = 'http://www.cakesucks.com/test.php';
	// 	$p1->postFields = array('testArray' => array(1,2,3,4));
	//
	// 	$p2 = N::makeParameters('POST');
	// 	$p2->URL = 'http://www.cakesucks.com/test.php';
	// 	$p2->postFields = array('testArray' => array(5,6,7,8));
	//
	// 	$p3 = new stdClass();
	// 	$p3->URL = 'http://www.cakesucks.com/test3.php';
	// 	$p3->postFields = array('testArray' => array(9,10,11,12));
	//
	// 	$response = N::POSTMulti(array($p1, $p2, $p3));
	// }
}
