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


/**
 * Struct - A basic structure wrapper.  This is a very controlled way to create
 *          parameters for methods, template value holders, etc...
 *
 *          The goal of this class is to eliminate, as much as possible, the
 *          ambiguous nature of a template/class/method/etc
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Struct
{
	/**
	 * Holds the list of numeric values to be checked against if defined.
	 */
	protected static $___attrs_numeric = Array();

	/**
	 * Ensure that any attempt at accessing an invalid attribute method will
	 * result in an ErrorException being thrown.
	 *
	 */
	public function __get($invalidAttribute)
	{
		throw new \ErrorException('Trying to access an invalid attribute Struct::'.$invalidAttribute);
	}

	public function __set($invalidAttribute, $sValue)
	{
		throw new \ErrorException('Trying to write to an invalid attribute Struct::'.$invalidAttribute);
	}


	public function validate($key)
	{
		if(!empty($this->{$key}) && in_array($key, self::$___attrs_numeric) && !is_numeric($this->{$key})) {
			throw new \ErrorException(
				'The value ['.$this->{$key}.'] for the attribute ['.$key.'] is not numeric.'
			);
		}
	}
}
