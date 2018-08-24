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
	protected $pathOriginal = null;
	protected $path = null;
	protected $aliases = array();
	protected $controller;
	protected $action;
	protected $parameters = array();

	public function __construct()
	{
		$this->pathOriginal = G::$request->getRequestedPath();
		$this->path = $this->translate($this->pathOriginal);
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
		$search = array(
			 '/^\%i$/'
			,'/^\%s$/'
		);
		$replace = array(
			 '[0-9]+'
			,'[a-zA-Z0-9\-\.\%\@_\=]+'
		);
		$regexAliases = array();
		foreach($this->aliases as $alias => $route) {
			$parts      = explode('/', $alias);
			$regexParts = array();
			foreach($parts as $part) {
				if(empty($part)) {
					continue;
				}
				$regexPart = preg_replace($search, $replace, $part, -1, $found);
				if($found <= 0) {
					$regexPart = preg_replace('/\-/', '\\-', $regexPart);
				}
				$regexParts[] = '/^'.$regexPart.'$/';
			}
			$regexAliases[$alias] = array('regex' => $regexParts, 'route' => $route);
		}

		$path = preg_replace('/^\//', '', $path);
		$pathParts = explode('/', $path);

		$matches = array();
		foreach($regexAliases as $alias => $conf) {

			$match = true;
			$i = 0;
			foreach($conf['regex'] as $pattern) {
				if(!isset($pathParts[$i])) {
					$match = false;
					break;
				}
				if(!preg_match($pattern, $pathParts[$i])) {
					$match = false;
				}

				$i++;

				if($match === false) {
					break;
				}
			}
			if($match === true) {
				$matches[$i] = $alias;
			}
		}

		if(count($matches) <= 0) {
			return $path;
		}
		ksort($matches);
		$aliasMatch = array_pop($matches);

		$pathParts = explode('/', preg_replace('/^\//', '', $path));
		$aliasParts = explode('/', preg_replace('/^\//', '', $aliasMatch));

		$c = count($aliasParts);
		for($i=0; $i<$c; $i++) {

			$pathPart  = array_shift($pathParts);
			$aliasPart = array_shift($aliasParts);

			if($pathPart == $aliasPart) {
				continue;
			}
			$type = 'integer';
			$partCheck = preg_replace('/^[0-9]+$/', '%i', $pathPart, -1, $found);
			if($found <= 0) {
				$type = 'string';
				$partCheck = preg_replace('/^[a-z0-9A-Z\-\.\%\@_\=]+$/', '%s', $pathPart, -1, $found);
			}

			$parameterValues[$type][] = $pathPart;
		}

		$realPath = $this->aliases[$aliasMatch];

		$v = (isset($parameterValues['integer'])) ? count($parameterValues['integer']) : 0;
		for($i=1; $i<=$v; $i++) {
			$realPath = preg_replace('/\$i'.$i.'/', $parameterValues['integer'][$i-1], $realPath);
		}
		$v = (isset($parameterValues['string'])) ? count($parameterValues['string']) : 0;
		for($i=1; $i<=$v; $i++) {
			$realPath = preg_replace('/\$s'.$i.'/', $parameterValues['string'][$i-1], $realPath);
		}

		if(count($pathParts) > 0) {
			$realPath .= '/'.implode('/', $pathParts);
		}

		return $realPath;
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
				$key  = null;
			}
			else if(preg_match('/^[a-zA-Z_][a-zA-Z0-9\-_]*$/', $part)) {
				if(is_null($key)) {
					$key = $part;
				}
			}
			else {
				// TODO: Log an invalid parameter
			}
			if(!is_null($key) && !isset($this->parameters[$key])) {
				$this->parameters[$key] = true;
				$key = null;
			}
		}
	}

	public function alias($path, $alias)
	{
		$this->aliases[$alias] = $path;
	}
}
