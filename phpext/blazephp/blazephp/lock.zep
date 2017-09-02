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


class Lock extends Struct
{
	private lockFileLocation;

	public function __construct(procName)
	{
		let this->lockFileLocation = ABS_VAR . "/lock/" . procName . ".lock";

		if(file_exists(this->lockFileLocation)) {

			var now, fileTime, diff, fileAge;

			let now      = new \DateTime();
			let fileTime = new \DateTime(date("Y-m-d H:i:s", filemtime(this->lockFileLocation)));
			let diff     = now->diff(fileTime);

			let fileAge = implode("", [
				 diff->d . " days, "
				,str_pad(diff->h, 2, "0", STR_PAD_LEFT)
				,":"
				,str_pad(diff->i, 2, "0", STR_PAD_LEFT)
				,":"
				,str_pad(diff->s, 2, "0", STR_PAD_LEFT)
			]);

			throw new \Exception(
				"The lock file exists for [" . procName . "], age: [" . fileAge . "], location: [" . this->lockFileLocation . "]"
			);
		}
		else {
			var fp;
			let fp = fopen(this->lockFileLocation, "w");
			fwrite(fp, this->lockFileLocation);
			fclose(fp);
		}
	}

	public function __destruct()
	{
		unlink(this->lockFileLocation);
	}

	public function fileLocation()
	{
		return this->lockFileLocation;
	}
}
