<?php
namespace BlazePHP;

ini_set('max_execution_time', '0');

date_default_timezone_set('UTC');

define('ABS_ROOT', dirname(__DIR__));
define('ABS_VAR',  ABS_ROOT.'/var');

require_once(ABS_ROOT.'/lib/Struct.class.php');
require_once(ABS_ROOT.'/lib/Globals.class.php');
require_once(ABS_ROOT.'/lib/CLI.class.php');
require_once(ABS_ROOT.'/lib/Message.class.php');


abstract class initCLI_common
{
	public static function parse($cli)
	{
		// Log output file
		$o              = new \BlazePHP\CLIOption();
		$o->long        = 'log-file-name';
		//$o->short       = 'L';
		$o->required    = false;
		$o->description = 'Log all output, adding timestamps, to the specified file that will '
		                 .'reside in the directory: [ABS_ROOT/log]'
		                 ."\n".'The default name prefix of the file will be the script basename.'
		                 ."\n".'See also: --log-level';
		$cli->addOption($o);

		// Log output level
		$o              = new \BlazePHP\CLIOption();
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
			\M::error('ERROR: '.$e->getMessage(), \M::ADD_NEW_LINE, 'red');
			exit;
		}

		// Send the help to the screen if it has been requested
		if($cli->help === true) {
			echo $cli->getHelp();
			exit;
		}

		// // Load the configuration
		// if($cli->config !== null) {
		// 	$configName = $cli->config;
		// 	$configName = preg_replace('/[^A-Za-z0-9\-]/', '', $configName);
		// 	if(!file_exists(ABS_ROOT.'/conf/'.$configName.'.conf.php')) {
		// 		$cli->error('The configuration ['.$configName.'] was not found.  Please review your options and try again');
		// 		exit;
		// 	}
		// 	else {
		// 		require(ABS_ROOT.'/conf/'.$configName.'.conf.php');
		// 	}
		// }


		// Create the log if specified
		$logFileName = $cli->logFileName;
		$logLevel    = \G::$cli->logLevel;
		// printre($logFileName);
		try {
			if(!empty($logFileName)) {
				\G::$log = new \BlazePHP\Log(\G::$cli->logFileName, $logLevel);
			}
			else {
				\G::$log = new \BlazePHP\Log(\G::$cli->getScriptName(), $logLevel);
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



/**
 * Define the autoload method from the Environment object
 */
spl_autoload_register(
	function($className) {
		$parts = explode('\\', $className);

		$search  = array();
		$replace = array();
		if(count(\G::$autoload) > 0) {

			foreach(\G::$autoload as $translate) {
				$map = explode(':', $translate);
				if(count($map) != 2) {
					ob_start();
					debug_print_backtrace();
					$backtrace = ob_get_contents();
					ob_clean();
					throw new \Exception(
						'AUTOLOADER - The G::$autoload array contains invalid data ['.$translate.'].'
						."\n\n"
						.$backtrace
					);
				}
				$search[]  = '/'.$map[0].'/';
				$replace[] = $map[1];
			}
			$path = preg_replace($search, $replace, implode('/', $parts));
		}

		if(file_exists(ABS_ROOT.'/'.$path.'.class.php')) {
			$classLocation = ABS_ROOT.'/'.$path.'.class.php';
		}
		else {
			ob_start();
			debug_print_backtrace();
			$backtrace = ob_get_contents();
			ob_clean();
			throw new \Exception(
				'AUTOLOADER - The class ['.$className.'] does not exist.'
				."\n\n"
				.$backtrace
			);
		}

		require_once($classLocation);
	}
);






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
