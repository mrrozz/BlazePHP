namespace BlazePHP;


class UniqueId
{
	public static function make(string prefix="", string suffix="")
	{
		var lock, thisSecond, id;

		let thisSecond   = date("YmdHis") . microtime(true);
		let lock         = new Lock("blaze_session_lock-" . thisSecond);
		let id     = prefix . uniqid(1, true) . suffix;
		let lock = null;

		return id;
	}
}
