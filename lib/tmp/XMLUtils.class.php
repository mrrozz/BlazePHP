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
 * XMLUtils
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class XMLUtils extends Struct
{
	private static $bftVars;

	public static function buildFromTemplate($___template, $___tplValues)
	{
		self::$bftVars = new stdclass();

		self::$bftVars->args = func_get_args();
		self::$bftVars->template  = self::$bftVars->args[0];
		self::$bftVars->tplValues = self::$bftVars->args[1];

		self::$bftVars->templateLoc = ABS_ROOT.'/templates/'.self::$bftVars->template.'.tpl.php';

		if(!file_exists(self::$bftVars->templateLoc)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - The template was not found. ['.self::$bftVars->templateLoc.']'
			)));
		}

		self::$bftVars->tplValues = self::cleanValues(self::$bftVars->tplValues);
		foreach(self::$bftVars->tplValues as $name => $value) {
			${$name} = $value;
		}

		ob_start();
		include(self::$bftVars->templateLoc);
		self::$bftVars->xmlRequest = ob_get_contents();
		ob_end_clean();

		return self::$bftVars->xmlRequest;
	}


	public static function cleanValues($values)
	{
		if(!is_array($values)) {
			if(strip_tags($values) != $values) {
			 	return '<![CDATA['.preg_replace('/\]\]\>/', '', $values).']]>';
			}
			else {
				return $values;
			}
		}
		else {
			foreach($values as $name => $value) {
				$values[$name] = self::cleanValues($value);
			}

			return $values;
		}
	}

	public static function getElementValue($element, $default=null)
	{
		if(!is_object($element) || get_class($element) != 'SimpleXMLElement') {
			return $default;
		}
		$element = (array)$element;
		return (!empty($element[0])) ? $element[0] : $default;
	}

	public static function getElementAttribute($element, $attribute, $default=null, $debug=false)
	{
		// if($debug) {
		// 	printr($element);
		// }

		if(!is_object($element) || get_class($element) != 'SimpleXMLElement') {
			return $default;
		}
		$element = (array)$element;
		// if($debug) {
		// 	printre($element);
		// }
		if(!isset($element['@attributes'][$attribute])) {
			// if($debug) {
			// 	printre('made it');
			// }
			return $default;
		}
		// if($debug) {
		// 	printre('made it');
		// }
		$return = (strlen($element['@attributes'][$attribute]) > 0) ? $element['@attributes'][$attribute] : $default;

		// if($debug) {
		// 	printre($return);
		// }
		// printre($return);
		return $return;
	}
}
