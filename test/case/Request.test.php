<?php
namespace BlazeTest;
use \BlazePHP\Request as R;
use BlazeTest\TestCase;


final class RequestTest extends TestCase
{

	public function testInstanceCreates()
	{
		$this->assertInstanceOf(R::class, new R());
	}

	// public function __get(name)
	public function testGetMethod()
	{
		$request = new R();

		$_SERVER['REQUEST_METHOD'] = 'GET';

		$this->assertTrue('GET' === $request->getMethod());
	}


	public function testIsPost()
	{
		$request = new R();

		$_SERVER['REQUEST_METHOD'] = 'POST';

		$this->assertTrue(true === $request->isPOST());
	}


	public function testIsGet()
	{
		$request = new R();

		$_SERVER['REQUEST_METHOD'] = 'GET';

		$this->assertTrue(true === $request->isGET());
	}


	public function testIsPut()
	{
		$request = new R();

		$_SERVER['REQUEST_METHOD'] = 'PUT';

		$this->assertTrue(true === $request->isPUT());
	}


	public function testIsDelete()
	{
		$request = new R();

		$_SERVER['REQUEST_METHOD'] = 'DELETE';

		$this->assertTrue(true === $request->isDELETE());
	}


	public function testIsAjax()
	{
		$request = new R();

		$_SERVER["HTTP_X_REQUESTED_WITH"] = "XMLHttpRequest";

		$this->assertTrue(true === $request->isAJAX());
	}


}
