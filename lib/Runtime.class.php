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
 *
 */
namespace BlazePHP;


/**
 * Runtime
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Runtime
{

	private $runtimeLoc;
	private $lastRuntime;
	private $logRuntime = false;
	private $runtime;
	public  $overlapBuffer = 0;

	public function __construct($name, $seed=false)
	{
		// Runtime is always in UTC
		$this->runtime = gmdate('Y-m-d H:i:s');

		$this->runtimeLoc = implode('/', array(ABS_VAR, 'runtime', $name.'.runtime'));

		if(!file_exists($this->runtimeLoc) && $seed === false) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The run time file is missing ['.$this->runtimeLoc.']  Please sead the '
				,'file with the last datetime that the data was syncronized. [YYYY-MM-DD HH:II:SS]'
			)));
		}
		elseif(!file_exists($this->runtimeLoc) && ($seed === true)) {
			$runtimeHandle = fopen($this->runtimeLoc, 'w');
			fwrite($runtimeHandle, $this->runtime);
			fclose($runtimeHandle);
			return self::__construct($name);
		}

		$lastRuntime = file($this->runtimeLoc);
		$lastRuntime = new \DateTime(trim($lastRuntime[0]));

		if((integer)$this->overlapBuffer < 0) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The overlap buffer received by the Runtime contructor is invalid ['.(string)(integer)$this->overlapBuffer.']'
			)));
		}
		elseif((integer)$this->overlapBuffer === 0) {
			$this->lastRuntime = $lastRuntime->format('Y-m-d H:i:s');
		}
		else {
			$lastRuntime->sub(new \DateInterval('PT'.(string)(integer)$this->overlapBuffer.'S'));
			// Delay the last runtime by [$this->overlapBuffer] seconds to cover SQL replication lag
			$this->lastRuntime = $lastRuntime->format('Y-m-d H:i:s');
		}
	}


	public function __destruct()
	{
		if($this->logRuntime === true) {
			$runtimeHandle = fopen($this->runtimeLoc, 'w');
			fwrite($runtimeHandle, $this->runtime);
			fclose($runtimeHandle);
		}
	}


	private function seed()
	{

	}


	public function success()
	{
		$this->logRuntime = true;
	}


	public function fail()
	{
		$this->logRuntime = false;
	}


	public function last()
	{
		return $this->lastRuntime;
	}


	public function fileLocation()
	{
		return $this->runtimeLoc;
	}
}
