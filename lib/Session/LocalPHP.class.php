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
namespace BlazePHP\Session;
use BlazePHP\Session as S;

/**
 * Runtime
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class LocalPHP
{
	private $status;

	public function __construct()
	{
		session_start();
		$this->status = session_status();
		session_write_close();
	}

	public function __get($key)
	{
		if(isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		else {
			return null;
		}
	}

	public function __set($key, $value)
	{
		session_start();
		$_SESSION[$key] = $value;
		session_write_close();
	}

	public function URLToken()
	{
		return session_name().'='.session_id();
	}

	public function status()
	{
		switch($this->status) {
			case PHP_SESSION_DISABLED:
				return S::STATUS_DISABLED;
				break;

			case PHP_SESSION_ACTIVE:
				return S::STATUS_ACTIVE;
				break;

			case PHP_SESSION_NONE:
			default;
				return S::STATUS_NONE;
				break;
		}
	}

	public function save()
	{
		return true; // This session type automatically writes each value as it it set
	}
}
