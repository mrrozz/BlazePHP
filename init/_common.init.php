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
use BlazePHP\Message as M;
use BlazePHP\CLI;

ini_set('max_execution_time', '0');

date_default_timezone_set('UTC');

define('ABS_ROOT',      dirname(__DIR__));
define('ABS_VAR',       ABS_ROOT.'/var');
define('ABS_TMP',       ABS_ROOT.'/var/tmp');
define('ABS_LOCK',      ABS_ROOT.'/var/lock');
define('ABS_RUNTIME',   ABS_ROOT.'/var/runtime');
define('ABS_LOG',       ABS_ROOT.'/var/log');
define('ABS_CHECKSUM',  ABS_ROOT.'/var/checksum');
define('ABS_MODULE',    ABS_ROOT.'/module');

require_once(ABS_ROOT.'/lib/Struct.class.php');
require_once(ABS_ROOT.'/lib/Globals.class.php');
require_once(ABS_ROOT.'/lib/CLI.class.php');
require_once(ABS_ROOT.'/lib/Message.class.php');




abstract class initCLI_common
{
	public static function parse($cli)
	{

		// Log output file
		$o              = new CLI\Option();
		$o->long        = 'log-file-name';
		//$o->short       = 'L';
		$o->required    = false;
		$o->description = 'Log all output, adding timestamps, to the specified file that will '
		                 .'reside in the directory: [ABS_ROOT/log]'
		                 ."\n".'The default name prefix of the file will be the script basename.'
		                 ."\n".'See also: --log-level';
		$cli->addOption($o);

		// Log output level
		$o              = new CLI\Option();
		$o->long        = 'log-level';
		//$o->short       = 'O';
		$o->required    = false;
		$o->default     = 0;
		$o->description = 'Sets the log level, the higher the number, the more information is logged.'."\n".'(0 = silent, >0 = more log entries)';
		$cli->addOption($o);



		// Parse the arguments and kick an error if there is something that is not recognized
		try {
			$cli->parse();
		}
		catch(\Exception $e) {
			M::error('ERROR: '.$e->getMessage(), M::ADD_NEW_LINE, 'red');
			exit;
		}

		// Send the help to the screen if it has been requested
		if($cli->help === true) {
			echo $cli->getHelp();
			exit;
		}


		// Create the log if specified
		$logFileName = $cli->logFileName;
		$logLevel    = G::$cli->logLevel;
		// printre($logFileName);
		try {
			if(!empty($logFileName)) {
				G::$log = new \BlazePHP\Log(G::$cli->logFileName, $logLevel);
			}
			elseif(!empty($logLevel)) {
				G::$log = new \BlazePHP\Log(G::$cli->getScriptName(), $logLevel);
			}
		}
		catch(\Exception $e) {
			$cli->error(
				 'The log file name ['.$logFileName.'] is invalid.  Please verify the location and permissions.'
				."\n\n".' Error: '.$e->getMessage()
			);
			exit;
		}

		return;
	}
}










set_error_handler(
	function($errno, $errstr, $errfile, $errline) {

		$backtraceList = debug_backtrace();
		$output = array();
		for ($i=0; $i<count($backtraceList); $i++) {
			$step     = $backtraceList[$i];
			$file     = '';
			$line     = '';
			$function = '';
			$omit     = false;
			foreach ($step as $type => $value) {
				if ($type === 'file' && __FILE__ == $value) {
					$omit = true;
					break;
				}

				if($type === 'file') {
					$file = $value;
				}
				elseif($type === 'line') {
					$line = $value;
				}
				elseif($type === 'function') {
					$function = $value;
				}
			}

			if ($omit === false) {
				$output[] = '[file: '.$file.' :: '.$line.'] -> '.$function.'()';
			}
		}

		throw new \ErrorException(
			 'BlazePHP CLI ERROR: '.$errstr."\n\n-- Debug Backtrace Output --\n".implode("\n", $output)
			,$errno
			,E_ERROR
			,$errfile
			,$errline
		);
		return;
	}
);
