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
 * ControllerAPI
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
abstract class ControllerAPI extends Struct
{
	public function before()
	{
		return null;
	}

	public function after()
	{
		return null;
	}

	public function notfound()
	{
		header("HTTP/1.0 404 Not Found");
		die('Request is invalid');
	}

	protected function redirect($destination)
	{
		header('HTTP/1.1 302 Found');
		header('Location: ' . $destination);
	}

	public function renderJSON($output)
	{
		header('Content-Type: application/json');
		echo json_encode($output);
		return;
	}

	public function invalidRequest()
	{
		header("HTTP/1.0 405 Method Not Allowed");
		die('Method Not Allowed');
	}
}