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
use \BlazePHP\Globals as G;
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

	public function notAuthorized()
	{
		header("HTTP/1.0 401 Unauthorized");
		die('Request is not authorized.');
	}

	protected function redirect($destination)
	{
		header('HTTP/1.1 302 Found');
		header('Location: ' . $destination);
		exit;
	}

	protected function redirectPerm($destination)
	{
		header('HTTP/1.1 301 Found');
		header('Location: ' . $destination);
		exit;
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

	public function getRequestedPath()
	{
		return G::$request->getRequestedPath();
	}

	public function getParameters()
	{
		return G::$route->getParameters();
	}

	public function buildResponse()
	{
		return new APIResponse();
	}
}


class APIResponse extends Struct
{
	public $status   = 'success';
	public $messages = array();
	public $data     = null;

	public function __construct()
	{
		$this->data = new \stdClass();
	}
}
