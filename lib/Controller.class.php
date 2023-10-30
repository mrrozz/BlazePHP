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
use BlazePHP\ControllerAPI;
use BlazePHP\Debug as D;
/**
 * ControllerValues - Static values that are used to hold the values set within a controller.
 *                    This avoids variable name collision.
 */
class ControllerValues extends Struct
{
	public static $variables = array();
	public static $layout    = 'default';
	public static $key       = null;
	public static $value     = null;

	public static function reset()
	{
		self::$variables = array();
		self::$layout    = 'default';
		self::$key       = null;
		self::$value     = null;
	}
}

/**
 * Controller
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
abstract class Controller extends ControllerAPI
{
	public function __construct()
	{
		ControllerValues::reset();
	}

	/**
	 * This used to set the values that will be parsed into the view files.  When
	 * you set controller attribute other than the three reserved (viewPath,
	 * viewFiles, values), the value is stored inside of values and is then
	 * parsed into the view files when buildViews is called.
	 *
	 * $param $key The key/name of the variable to store
	 * $return The value, if it exists inside of the values array
	 */
	public function __get($key)
	{
		return (isset(ControllerValues::$variables[$key])) ? ControllerValues::$variables[$key] : null;
	}



	/**
	 * Used to set the values to be parsed into the view files.  See self::__get()
	 * for more information
	 *
	 * @param $key The key to store the value under in values
	 * @value The actual value of the key
	 */
	public function __set($key, $value)
	{
		ControllerValues::$variables[$key] = $value;
	}



	/**
	 * Sets the layout to be used
	 *
	 * @param $layout
	 * @return - void
	 */
	public function setLayout($layout)
	{
		if(!file_exists(MODULE_ROOT.'/view-layout/'.$layout.'.layout.php')) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - The layout file ['.$layout.'] specified does not exist.'
			)));
		}

		ControllerValues::$layout = $layout;
	}





	/**
	 * Renders the output using a layout if one has been set
	 */
	private function processLayout($returnContent)
	{

		if(!file_exists(ControllerValues::$layout)) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - The layout file ['.ControllerValues::$layout.'] does not exist'
			)));
		}

		foreach(ControllerValues::$variables as ControllerValues::$key => ControllerValues::$value) {
			${ControllerValues::$key} = ControllerValues::$value;
		}

		if($returnContent === true) {
			ob_start();
		}

		include(ControllerValues::$layout);

		if($returnContent === true) {
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		}

		return true;
	}




	/**
	 * Renders the output and returns the value
	 */
	public function renderReturn()
	{
		// D::printre(ControllerValues::$layout);
		return $this->processFile('view-layout', ControllerValues::$layout, true);
	}

	/**
	 * Renders the output to the screen
	 */
	public function render()
	{
		return $this->processFile('view-layout', ControllerValues::$layout, false);
	}

	public function renderView($file)
	{
		return $this->processFile('view', $file, false);
	}

	public function renderViewCSS($file)
	{
		header('Content-Type: text/css');
		return $this->processFile('view', $file, false);
	}

	public function renderViewReturn($file) {
		return $this->processFile('view', $file, true);
	}

	public function renderWidgetReturn($file) {
		return $this->processFile('view-widget', $file, true);
	}

	private function processFile($type, $file, $returnContent)
	{
		switch($type) {
			case 'view':
				$fileDir   = 'view';
				$extention = 'view';
				break;

			case 'view-layout':
				$fileDir   = 'view-layout';
				$extention = 'layout';
				break;

			case 'view-element':
				$fileDir   = 'view-element';
				$extention = 'element';
				break;

			case 'view-widget':
				$fileDir   = 'view-widget';
				$extention = 'widget';
				break;
		}
		$fileLoc = MODULE_ROOT.'/'.$fileDir.'/'.$file.'.'.$extention.'.php';

		if(!file_exists($fileLoc)) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - The file ['.$fileLoc.'] was not found.'
			)));
		}


		foreach(ControllerValues::$variables as ControllerValues::$key => ControllerValues::$value) {
			${ControllerValues::$key} = ControllerValues::$value;
		}

		if($returnContent === true) {
			ob_start();
		}

		include($fileLoc);

		if($returnContent === true) {
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		}

		return true;
	}
}
