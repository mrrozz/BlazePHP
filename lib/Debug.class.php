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
 */
namespace BlazePHP;
use BlazePHP\Globals as G;


/**
 * Class Debug
 *
 * Debugging tools for on screen and console output.  Backtracing is available.
 *
 * If the environment has debugging disabled then the class is created
 * with all method opperations throwing an exception.
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 * @alias     D
 */
if (G::$debug === true) {

	class Debug
	{
		public static $timer;

		/**
		 * This method sends content to the console service.  In order to start the service
		 * please see /bin/console for more information.
		 *
		 * @param data Any data that is to be sent to the console
		 * @param showBacktrace If true, a full backtrace is also sent to the console
		 * @param port Any valid port that the server is listening to
		 *
		 */
		public static function console($data, $showBacktrace = false, $port = 8000)
		{
			if ('ON' !== DEBUG_SWITCH) {
				return;
			}
			$dataType = gettype($data);

			$backtrace = self::backtrace();

			ob_start();

			if ($showBacktrace === true) {
				foreach ($backtrace as $fileLocation) {
					echo 'FILE: ', $fileLocation, ' ', "\n";
				}
			}
			else {
				if (!empty($backtrace[0])) {
					echo 'FILE: ', $backtrace[0], ' ';
				}
				else {
					echo 'DATA: ';
				}
			}
			switch($dataType) {

				case 'boolean':
					print("[boolean]\n" . (($data == true) ? 'TRUE' : 'FALSE'));
					print "\n";
					break;

				case 'string':
					print("[string]\n" . $data);
					print "\n";
					break;

				case 'integer':
					print("[integer]\n" . $data);
					print "\n";
					break;

				case 'double':
					print("[double]\n" . $data);
					print "\n";
					break;

				case 'array':
					print "[array]\n";
					print_r($data);
					print "\n";
					break;

				case 'object':
					print "[object]\n";
					print_r($data);
					print "\n";
					break;

				case 'resource':
					print "[resource]\n";
					var_dump($data);
					print "\n";
					break;
			}

			$content = ob_get_clean();



			$console = stream_socket_client('tcp://0.0.0.0:'.(string)$port, $errno, $errstr, 30);

			if (!$console) {
				echo "$errstr ($errno)<br />\n";
			}
			else {
				fwrite($console, $content, strlen($content));
				fclose($console);
			}
		}




		/**
		 * Logs time the time laps between calls.  This can be helpful in determining
		 * bottlenecks.
		 *
		 * @param $id prefix on all timer output
		 * @param $showBacktrace True prints full backtrace in console output, False shows only the file name
		 * @param $port The port used to connect to the console listener
		 */
		public static function timer($id, $showBacktrace = false, $port = 8000)
		{
			if(true !== Toolbox::paramBoolean('log_time')) {
				return;
			}
			if(!is_array(self::$timer)) {
				list(self::$timer['msec'], self::$timer['sec']) = explode(' ', microtime());
				$laps = '0.0000000';
			}
			else {
				list($msec, $sec) = explode(' ', microtime());
				$secLaps  = $sec  - self::$timer['sec'];
				$msecLaps = $msec - self::$timer['msec'];
				$laps = (string)($secLaps+$msecLaps);
				self::$timer['msec'] = $msec;
				self::$timer['sec']  = $sec;

			}

			$backtrace = self::backtrace();

			$content = '';

			if ($showBacktrace === true) {
				foreach ($backtrace as $fileLocation) {
					$content .= 'FILE: '. $fileLocation. ' '. "\n";
				}
			}
			else {
				if (!empty($backtrace[0])) {
					$content .= 'FILE: '. $backtrace[0]. ' ';
				}
			}

			$content .= "\n".$id.' [Time Laps: '.$laps."]\n\n";

			$console = stream_socket_client('tcp://0.0.0.0:'.(string)$port, $errno, $errstr, 30);

			if (!$console) {
				echo "$errstr ($errno)<br />\n";
			}
			else {
				fwrite($console, $content, strlen($content));
				fclose($console);
			}
		}



		/**
		 * Print human readable information about a variable enclosed in <pre>...</pre> tags
		 *
		 * @param variable - Any variable of any type
		 * @param hault - If set to true, stop processing after this output [false]
		 * @param showBacktrace - Include the backtrace with this output [false]
		 * @return void
		 */
		public static function printr($variable, $hault = false, $showBacktrace = false)
		{
			echo '<pre>', "\n\n";
			$backtraceList = self::backtrace();
			if ($showBacktrace === true) {
				foreach ($backtraceList as $fileLocation) {
					echo 'FILE: ', $fileLocation, ' ', "\n";
				}
			}
			else {
				echo 'FILE: ', $backtraceList[0], ' ';
			}
			print_r($variable);
			echo "\n\n",'</pre>';

			if ($hault === true) {
				exit;
			}
		}


		/**
		 * Print human readable information about a variable enclosed in <pre>...</pre> tags
		 * and haults the process after the output.
		 *
		 * @param variable - Any variable of any type
		 * @param showBacktrace - Include the backtrace with this output [false]
		 * @return void
		 */
		public static function printre($variable, $showBacktrace = false)
		{
			self::printr($variable, true, $showBacktrace);
		}




		/**
		 * Builds and returns the backtrace from the point at which a
		 * debug method (printr, printre, console) was called.  This file
		 * is omitted from the trace.
		 *
		 * @param
		 */
		public static function backtrace()
		{
			$backtraceList = debug_backtrace();

			$returnList = Array();
			for ($i=0; $i<count($backtraceList); $i++) {
				$step = $backtraceList[$i];
				$stepFormatted = '';
				$omit = false;
				foreach ($step as $type => $value) {
					if ($type === 'file' && __FILE__ == $value) {
						$omit = true;
						break;
					}

					if (in_array($type, Array('file', 'line'))) {
						$stepFormatted .= '['.$value.']';
					}
				}

				if ($omit === false) {
					$returnList[] = $stepFormatted;
				}
			}

			return $returnList;
		}
	}
}
elseif(G::$debug === false) {

	class Debug
	{
		public static function console() {
			throw new \Exception('Debug mode is not enabled.');
		}

		public static function timer() {
			throw new \Exception('Debug mode is not enabled.');
		}

		public static function printr() {
			throw new \Exception('Debug mode is not enabled.');
		}

		public static function printre() {
			throw new \Exception('Debug mode is not enabled.');
		}

		public static function backtrace() {
			throw new \Exception('Debug mode is not enabled.');
		}
	}
}
else {

	class Debug
	{
		public static function console() {
			return;
		}

		public static function timer() {
			return;
		}

		public static function printr() {
			return;
		}

		public static function printre() {
			return;
		}

		public static function backtrace() {
			return;
		}
	}
}
class_alias('\BlazePHP\Debug', 'D');
