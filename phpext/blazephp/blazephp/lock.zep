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
	private isLockOwner = false;

	public function __construct(procName)
	{
		let this->lockFileLocation = ABS_VAR . "/lock/" . preg_replace("/[^a-zA-Z0-9\-_]/", "", procName) . ".lock";
		// let this->lockFileLocation = "/tmp/" . preg_replace("/[^a-zA-Z0-9_]/", "_", procName) . ".sock";

		if(file_exists(this->lockFileLocation)) {

			var processLine, processParts, processId, processSignature;
			let processLine  = file_get_contents(this->lockFileLocation);
			let processParts = explode("-", processLine);
			if isset(processParts[0]) {
				let processId = processParts[0];
			}
			if isset(processParts[1]) {
				let processSignature = processParts[1];
			}
			if this->getProcessSignature(processId) != processSignature {
				unlink(this->lockFileLocation);
				this->__construct(procName);
				return;
			}

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
			var fp, processId, procSignature;
			let processId     = getmypid();
			let fp            = fopen(this->lockFileLocation, "w");
			let procSignature = this->getProcessSignature(processId);
			fwrite(fp, processId . "-" . procSignature);
			fclose(fp);
			let this->isLockOwner = true;
		}

		// Remove the lock file if the script is killed or dies without a proper exit
		// register_shutdown_function("unlink", this->lockFileLocation);
	}

	public function getProcessSignature(processId)
	{
		var psOutput, procSignature, line;
		exec("ps ahxwwo pid,command | grep " . processId, psOutput);
		for line in psOutput {
			// echo line, "\n";
			if preg_match("/^" . processId . "/", trim(line)) {
				return md5(line);
			}
		}
		return "no-process-found-for-pid-" . processId;
	}

	public function destruct()
	{
		this->__destruct();
		exit();
	}

	public function __destruct()
	{
		if this->isLockOwner == true {
			unlink(this->lockFileLocation);
		}
	}

	public function fileLocation()
	{
		return this->lockFileLocation;
	}
}
