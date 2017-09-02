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
use BlazePHP\Diff;
use BlazeTest\TestCase;

final class DiffTest extends TestCase
{
	private $log1;
	private $log2;

	public function testInstanceCreates()
	{
		$this->log1 = new \BlazePHP\Log(__CLASS__.'-file1', 1);
		$this->log2 = new \BlazePHP\Log(__CLASS__.'-file2', 1);

		for($i=0; $i<10; $i++) {
			$this->log1->write(1, 'LINE ENTRY: '.(string)$i);
			if($i % 2 == 0) {
				$this->log2->write(1, 'LINE ENTRY: '.(string)$i);
			}
		}

		$this->assertInstanceOf(Diff::class, new Diff($this->log1->fileLocation(), $this->log2->fileLocation()));
	}

	public function testDiffOutput()
	{
		$diff = new Diff($this->log1->fileLocation(), $this->log2->fileLocation());
		$this->assertNotEmpty($diff->read());
	}

}
