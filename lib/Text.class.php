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

define('PFORMAT_DATETIME', 'Y-m-d H:i:s');
define('PFORMAT_DATE',     'Y-m-d');
/**
 * Text - A general tool kit for text/string based functions
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Text
{
	/**
	 *
	 */
	public static function createCSVFromArray($list, $totals=null, $fileName='data', $withHeaders=true)
	{

		$csvLines = array();
		if(is_array($totals)) {
			foreach ($totals as $column => $values) {
				$csvLines[] = implode(',', $values);
			}
		}

		$first    = true;
		foreach($list as $line) {

			if($first === true && $withHeaders === true) {
				$first = false;
				$headersRaw = array_keys($line);
				$headers    = array();
				foreach($headersRaw as $header) {
					$headers[] = '"'.ucwords(preg_replace('/_/', ' ', $header)).'"';
				}
				$csvLines[] = implode(',', $headers);
			}

			$csvLine = array();
			foreach($line as $key => $value) {

				// If a value is an array, concatenate the line into one string
				if (is_array($value)) {
					foreach($value as $key => $part) {

						// Format the date/datetime parts
						if(preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $part)) {
							$part = new \DateTime($part);
							$value[$key] = $part->format(PFORMAT_DATE);
						}
						elseif(preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}\:[0-9]{2}\:[0-9]{2}$/', $part)) {
							$part = new \DateTime($part);
							$value[$key] = $part->format(PFORMAT_DATETIME);
						}
					}
					$value = implode(' ', $value);
				}

				// Format the date/datetime values
				if(preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $value)) {
					$value = new \DateTime($value);
					$value = $value->format(PFORMAT_DATE);
				}
				elseif(preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}\:[0-9]{2}\:[0-9]{2}$/', $value)) {
							$value = new \DateTime($value);
							$value = $value->format(PFORMAT_DATETIME);
						}

				// Build the CSV line array
				if(is_numeric($value)) {
					$csvLine[] = $value;
				}
				else {
					$csvLine[] = '"'.preg_replace('/\"/', '\"', $value).'"';
				}
			}

			$csvLines[] = implode(',', $csvLine);
		}


		return implode("\n", $csvLines)."\n";

	}





	/**
	 *
	 */
	public static function createCSVFromArrayMapped($list, $map, $fileName='data', $withHeaders=true)
	{
		$csv = array();
		foreach($list as $line) {
			$newLine = array();
			foreach($map as $key => $label) {
				$newLine[$label] = (isset($line[$key])) ? $line[$key] : null;
			}
			$csv[] = $newLine;
		}
		return self::createCSVFromArray($csv, null, $fileName, $withHeaders);
	}



	public static function createCSVFromArrayMappedWithTotals($list, $map, $totals, $fileName='data')
	{
		$csvTotals = array(array('Totals'));
		$newLineTotals = array();
		foreach($map as $key => $label) {
			$newLineTotals[$label] = (isset($totals[$key])) ? $totals[$key] : '';
		}
		$csvTotals[] = $newLineTotals;
		$csvTotals[] = array();

		foreach($list as $line) {
			$newLine = array();
			foreach($map as $key => $label) {
				$newLine[$label] = (isset($line[$key])) ? $line[$key] : null;
			}
			$csv[] = $newLine;
		}
		return self::createCSVFromArray($csv, $csvTotals, $fileName);
	}


	public static function stringWithoutAccentedCharacters($inputString)
	{
		return strtr($inputString, array(
			"\xC0" => 'A', // Capital A, grave accent
			"\xC1" => 'A', // Capital A, acute accent
			"\xC2" => 'A', // Capital A, circumflex accent
			"\xC3" => 'A', // Capital A, tilde
			"\xC4" => 'A', // Capital A, dieresis or umlaut mark
			"\xC5" => 'A', // Capital A, ring
			"\xC6" => 'A', // Capital AE dipthong (ligature)
			"\xC7" => 'C', // Capital C, cedilla
			"\xC8" => 'E', // Capital E, grave accent
			"\xC9" => 'E', // Capital E, acute accent
			"\xCA" => 'E', // Capital E, circumflex accent
			"\xCB" => 'E', // Capital E, dieresis or umlaut mark
			"\xCC" => 'I', // Capital I, grave accent
			"\xCD" => 'I', // Capital I, acute accent
			"\xCE" => 'I', // Capital I, circumflex accent
			"\xCF" => 'I', // Capital I, dieresis or umlaut mark
			"\xD0" => 'D', // Capital Eth, Icelandic
			"\xD1" => 'N', // Capital N, tilde
			"\xD2" => 'O', // Capital O, grave accent
			"\xD3" => 'O', // Capital O, acute accent
			"\xD4" => 'O', // Capital O, circumflex accent
			"\xD5" => 'O', // Capital O, tilde
			"\xD6" => 'O', // Capital O, dieresis or umlaut mark
			"\xD7" => 'x', // Multiply sign
			"\xD8" => 'O', // Capital O, slash
			"\xD9" => 'U', // Capital U, grave accent
			"\xDA" => 'U', // Capital U, acute accent
			"\xDB" => 'U', // Capital U, circumflex accent
			"\xDC" => 'U', // Capital U, dieresis or umlaut mark
			"\xDD" => 'Y', // Capital Y, acute accent
			"\xDE" => 'P', // Capital THORN, Icelandic
			"\xDF" => 's', // Small sharp s, German (sz ligature)
			"\xE0" => 'a', // Small a, grave accent
			"\xE1" => 'a', // Small a, acute accent
			"\xE2" => 'a', // Small a, circumflex accent
			"\xE3" => 'a', // Small a, tilde
			"\xE4" => 'a', // Small a, dieresis or umlaut mark
			"\xE5" => 'a', // Small a, ring
			"\xE6" => 'a', // Small ae dipthong (ligature)
			"\xE7" => 'c', // Small c, cedilla
			"\xE8" => 'e', // Small e, grave accent
			"\xE9" => 'e', // Small e, acute accent
			"\xEA" => 'e', // Small e, circumflex accent
			"\xEB" => 'e', // Small e, dieresis or umlaut mark
			"\xEC" => 'i', // Small i, grave accent
			"\xED" => 'i', // Small i, acute accent
			"\xEE" => 'i', // Small i, circumflex accent
			"\xEF" => 'i', // Small i, dieresis or umlaut mark
			"\xF0" => 'd', // Small eth, Icelandic
			"\xF1" => 'n', // Small n, tilde
			"\xF2" => 'o', // Small o, grave accent
			"\xF3" => 'o', // Small o, acute accent
			"\xF4" => 'o', // Small o, circumflex accent
			"\xF5" => 'o', // Small o, tilde
			"\xF6" => 'o', // Small o, dieresis or umlaut mark
			"\xF7" => '-', // Division sign
			"\xF8" => 'o', // Small o, slash
			"\xF9" => 'u', // Small u, grave accent
			"\xFA" => 'u', // Small u, acute accent
			"\xFB" => 'u', // Small u, circumflex accent
			"\xFC" => 'u', // Small u, dieresis or umlaut mark
			"\xFD" => 'y', // Small y, acute accent
			"\xFE" => 'p', // Small thorn, Icelandic
			"\xFF" => 'y', // Small y, dieresis or umlaut mark
		));
	}





	public static function parseDate($dateString)
	{

		if(!preg_match('/^[0-9]{4}\-[0-1][0-9]\-[0-3][0-9]$/', $dateString)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The date ['.$dateString.'] is not formatted properly. Format: YYYY-MM-DD'
			)));
		}

		return new DateTime($dateString);
	}




	public static function parseDateRange($dateRangeString)
	{

		if(!preg_match('/^[0-9]{4}\-[0-1][0-9]\-[0-3][0-9]\<\>[0-9]{4}\-[0-1][0-9]\-[0-3][0-9]$/', $dateRangeString)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The date range ['.$dateRangeString.'] is not formatted properly. Format: YYYY-MM-DD<>YYYY-MM-DD'
			)));
		}

		$parts = explode('<>', $dateRangeString);

		$dates = array(new DateTime($parts[0]), new DateTime($parts[1]));

		if($dates[0] > $dates[1]) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The first date ['.$dates[0]->format('Y-m-d').'] is not less than the second date ['.$dates[0]->format('Y-m-d').']'
			)));
		}

		return $dates;
	}



	public static function parseCSVNumericIdList($csvNumericIdList)
	{
		if(!preg_match('/^[0-9\,\-]*$/', $csvNumericIdList)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The numeric Id list passed ['.$csvNumericIdList.'] in is not valid.  Format: 12,34,56,78,90'
			)));
		}
		return explode(',', $csvNumericIdList);
	}


	public static function parseCSVMD5IdList($csvMD5IdList) {
		if(!preg_match('/^[a-fA-F0-9\,]*$/', $csvMD5IdList)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The MD5 Id list passed ['.$csvMD5IdList.'] in is not valid.  Format: 241f9c97004124922a5d6556a67b0393,7a1a70c93c2ba190aec7aadedad3347f'
			)));
		}
		return explode(',', $csvMD5IdList);
	}



	public static function encode64URL($url)
	{
		return urlencode(base64_encode($url));
	}
	public static function decode64URL($url64)
	{
		return base64_decode($url64);
	}




	/**
	 * This function takes a css-string and compresses it, removing
	 * unneccessary whitespace, colons, removing unneccessary px/em
	 * declarations etc.
	 *
	 * @param string $css
	 * @return string compressed css content
	 * @author Steffen Becker
	 */
	public static function minifyCSS($css) {
		// some of the following functions to minimize the css-output are directly taken
		// from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
		// all credits to Christian Schaefer: http://twitter.com/derSchepp
		// remove comments
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
		// backup values within single or double quotes
		preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
		for ($i=0; $i < count($hit[1]); $i++) {
		$css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
		}
		// remove traling semicolon of selector's last property
		$css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
		// remove any whitespace between semicolon and property-name
		$css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
		// remove any whitespace surrounding property-colon
		$css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
		// remove any whitespace surrounding selector-comma
		$css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
		// remove any whitespace surrounding opening parenthesis
		$css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
		// remove any whitespace between numbers and units
		$css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
		// shorten zero-values
		$css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
		// constrain multiple whitespaces
		$css = preg_replace('/\p{Zs}+/ims',' ', $css);
		// remove newlines
		$css = str_replace(array("\r\n", "\r", "\n"), '', $css);
		// Restore backupped values within single or double quotes
		for ($i=0; $i < count($hit[1]); $i++) {
		$css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
		}
		return $css;
	}
}
