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
class Session extends Struct
{
	private $session;

	const STATUS_ACTIVE   = 'ACTIVE';
	const STATUS_NONE     = 'NONE';
	const STATUS_DISABLED = 'DISABLED';

	public function __construct()
	{
		switch(G::$env->sessionType) {

			default;
				$this->session = new Session\LocalPHP();
				break;
		}

		if($this->session->status() != self::STATUS_ACTIVE) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - Session failed to activate'
			)));
		}
	}

	public function __get($key)
	{
		return $this->session->{$key};
	}

	public function __set($key, $value)
	{
		$this->session->{$key} = $value;
	}

	public function URLToken()
	{
		return $this->session->URLToken();
	}
}
