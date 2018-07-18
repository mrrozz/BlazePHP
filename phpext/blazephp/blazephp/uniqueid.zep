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


class UniqueId
{
	public static function make(string prefix="", string suffix="")
	{
		var lock, thisSecond, id;

		let thisSecond   = date("YmdHis") . microtime();
		let lock         = new Lock("blaze_session_lock-" . thisSecond);
		let id           = prefix . uniqid(1, true) . suffix;
		let lock         = null;

		return id;
	}
}
