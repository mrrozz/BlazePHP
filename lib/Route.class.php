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
use BlazePHP\Globals as G;
use BlazePHP\Debug   as D;

/**
 * Globals
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Route extends Struct
{
	protected $path = null;
	protected $aliases;
	protected $controller;
	protected $action;
	protected $parameters = array();

	public function __construct()
	{
		$this->path = $this->translate(G::$request->getRequestedPath());
		$this->parse();
	}

	public function getController()
	{
		return strtolower($this->controller);
	}

	public function getAction()
	{
		return (!empty($this->action)) ? strtolower($this->action) : 'index';
	}

	public function getParameters()
	{
		return $this->parameters;
	}

	public function translate($path)
	{
		// %i - the argument is treated as an unsigned integer with no variable assignment
		$parts           = explode('/', preg_replace('/^\/*/', '', $path));
		$test            = '';
		$realPath        = null;
		$parameters      = '';
		$parameterValues = array();
		$found           = false;

		foreach($parts as $part) {
			$partCheck = preg_replace('/^[0-9]+$/', '%i', $part);
			$test     .= '/'.$partCheck;
			if(isset($this->aliases[$test])) {
				$realPath        = $this->aliases[$test];
				$found          = true;
				$parameters      = '';
				$parameterValues[] = $part;
			}
			elseif(!is_null($realPath)) {
				$parameterValues = array();
				$found = false;
			}
		}
		$v = count($parameterValues);
		for($i=1; $i<=$v; $i++) {
			$realPath = preg_replace('/\$i'.$i.'/', $parameterValues[$i-1], $realPath);
		}

		if($found) {
			return $realPath.$parameters;
		}
		else {
			return $path;
		}
	}

	public function parse()
	{
		if(empty($this->path)) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - The path submitted is unknown. Please verify your route configuration and try again.'
			)));
		}

		$parts            = explode('/', preg_replace('/^\/*/', '', $this->path));
		$this->controller = (isset($parts[0])) ? array_shift($parts) : null;
		$this->action     = (isset($parts[0])) ? array_shift($parts) : null;

		$partsCount = count($parts);
		$key        = null;
		for($i=0; $i<$partsCount; $i++) {
			$part = array_shift($parts);
			if(preg_match('/\:/', $part)) {
				list($key, $value) = explode(':', $part);
				$this->parameters[$key] = $value;
			}
			else if(preg_match('/^[a-zA-Z_][a-zA-Z0-9\-]*$/', $part)) {
				if(is_null($key)) {
					$key = $part;
				}
				else {
					$this->parameters[$key] = $part;
					$key = null;
				}
			}
			else {
				// TODO: Log an invalid parameter
			}
			if(!is_null($key) && !isset($this->parameters[$key])) {
				$this->parameters[$key] = true;
			}
		}
	}

	public function alias($path, $alias)
	{
		$this->aliases[$alias] = $path;
	}
}
