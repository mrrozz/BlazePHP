<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2013, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     Copyright 2012 - 2013, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
namespace BlazePHP;
use BlazePHP\Globals as G;

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
	protected $parameters;

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

	public function parse()
	{
		if(empty($this->path)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - The path submitted is unknown. Please verify your route configuration and try again.'
			)));
		}
		// printre($this->path);
		$parts = explode('/', $this->path);
		// printre($parts);
		$this->controller = (isset($parts[0])) ? array_shift($parts) : null;
		$this->action     = (isset($parts[0])) ? array_shift($parts) : null;

		$partsCount = count($parts);
		for($i=0; $i<$partsCount; $i++) {
			$part = array_shift($parts);
			if(preg_match('/\:/', $part)) {
				list($key, $value) = explode(':', $part);
				$this->parameters[$key] = $value;
			}
			else if(preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $part)) {
				$this->parameters[$part] = true;
			}
			else {
				// TODO: Log an invalid parameter
			}
		}
	}

	public function alias($path, $alias)
	{
		$this->aliases[$alias] = $path;
	}

	public function translate($path)
	{
		// %i - the argument is treated as an unsigned integer with no variable assignment
		// %s - the argument is treated as and presented as a string matching the following pattern '[a-zA-Z0-9_\-\.] and is the value of an assignment'.

		$search = array(
			 '/\/[0-9]+/'
			,'/\:[a-zA-Z0-9_\-\.]+/'
		);
		$replace = array(
			 '/%i'
			,':%s'
		);
		$pathTemplate = preg_replace($search, $replace, $path);

		// printr($pathTemplate);
		if(!isset($this->aliases[$pathTemplate])) {
			// Remove the leading forward slash
			return substr($path, 1);
		}

		// Get the tranlation template
		$translateTemplate = $this->aliases[$pathTemplate];

		// Find all value matches from the path
		$allMatches = array();
		$i = 0;
		$types = array(0 => '$i', 1 => '$s');
		foreach($search as $pattern) {
			preg_match_all($pattern, $path, $matches);
			$allMatches[$types[$i++]] = $matches[0];
		}

		// printr($path);
		// printr($pathTemplate);
		// printr($translateTemplate);
		// printr($allMatches);

		$pathTranslated = $translateTemplate;
		foreach($allMatches as $type => $values) {
			foreach($values as $number => $value) {
				$pathTranslated = str_replace($type.($number+1), substr($value, 1), $pathTranslated);
			}
		}

		// Remove the leading forward slash
		return substr($pathTranslated, 1);
	}
}
