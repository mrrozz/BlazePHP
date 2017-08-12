<?php
namespace BlazeTest;
use \BlazePHP\UniqueId as UID;
use \BlazePHP\Struct;
use BlazeTest\TestCase;


final class UniqueIdTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(UID::class, new UID());
	}

	public function testMakeId()
	{
		$id = UID::make();
		$this->assertNotEmpty($id);
	}

	public function testMakeIdWithPrefix()
	{
		$id = UID::make('blazetest_');
		$this->assertNotEmpty($id);
		$this->assertTrue(1 === preg_match('/^blazetest_/', $id));
	}

	public function testMakeIdWithSuffix()
	{
		$id = UID::make(null, '_blazetest');
		$this->assertNotEmpty($id);
		$this->assertTrue(1 === preg_match('/_blazetest$/', $id));
	}

	public function testMakeIdWithPrefixAndSuffix()
	{
		$id = UID::make('blazetest_', '_blazetest');
		$this->assertNotEmpty($id);
		$this->assertTrue(1 === preg_match('/^blazetest_/', $id));
		$this->assertTrue(1 === preg_match('/_blazetest$/', $id));
	}
}
