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
 * Log
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Log extends Struct
{
	public  fp;
	private file;
	private addTimeStamp = true;

	public level;

	public function __construct(string namePrefix, int level)
	{
		let this->level = level;

		if(this->level <= 0) {
			return;
		}

		// Filter out special chars
		let namePrefix = preg_replace("/[^a-zA-Z0-9\-_\.]/", "_", namePrefix);

		let this->file = ABS_VAR . "/log/" . namePrefix . "-" . date("Y-m-d") . ".log";
		let this->fp   = fopen(this->file, 'a');
		if(!this->fp) {
			throw new \Exception(
				__CLASS__."::".__FUNCTION__." - There has been an error trying to open the log file [" . this->file . "]"
			);
		}
	}

	public function __destruct()
	{
		if(this->level <= 0) {
			return;
		}

		// Add a closing new-line-feed if the last log entry did not include it
		if(this->addTimeStamp === false) {
			fputs(this->fp, "\n");
		}

		fclose(this->fp);
	}



	public function write(int level, string message, bool addNewLine=true)
	{
		if(level > this->level) {
			return;
		}

		if(this->addTimeStamp === true) {
			let message            = "[" . date("Y-m-d H:i:s") . "] " . message;
			let this->addTimeStamp = false;
		}

		if(addNewLine === true) {
			let message            = message . "\n";
			let this->addTimeStamp = true;
		}

		fputs(this->fp, message);
	}



	public function fileLocation()
	{
		return this->file;
	}

}
