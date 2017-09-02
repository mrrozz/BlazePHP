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
use BlazePHP\Runtime;
use BlazeTest\TestCase;


final class RuntimeTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(Runtime::class, new Runtime(__CLASS__, true));
	}

	public function testRuntimeFileLocation()
	{
		$runtime = new Runtime(__CLASS__);
		$this->assertNotEmpty($runtime->fileLocation());
		unset($runtime);
	}
	//
	public function testRuntimeFileExists()
	{
		$runtime = new Runtime(__CLASS__);
		$this->assertFileExists($runtime->fileLocation());
		unset($runtime);
	}

	public function testRuntimeFileWriteable()
	{
		$runtime = new Runtime(__CLASS__);
		$this->assertFileWriteable($runtime->fileLocation());
		unset($runtime);
	}

	public function testRuntimeFileReadable()
	{
		$runtime = new Runtime(__CLASS__);
		$this->assertFileReadable($runtime->fileLocation());
		unset($runtime);
	}

	public function testWriteOnSuccess()
	{
		$runtime = new Runtime(__CLASS__);
		$last = $runtime->last();
		sleep(2);
		$runtime->success();
		unset($runtime);
		$runtime = new Runtime(__CLASS__);
		$this->assertTimeLapsAvsB($last, $runtime->last());
	}

	public function testNoWriteOnFail()
	{
		$runtime = new Runtime(__CLASS__);
		$last = $runtime->last();
		sleep(2);
		$runtime->fail();
		unset($runtime);
		$runtime = new Runtime(__CLASS__);
		$this->assertNoTimeLapsAvsB($last, $runtime->last());
	}

}
