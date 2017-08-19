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
 * Controller
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
abstract class Controller extends Struct
{
	public function before()
	{
		return;
	}

	public function after()
	{
		return;
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
}
