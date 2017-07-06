<?php


class JSONUtils
{
	public static function responseCheck($responseRaw, $fromMethod)
	{
		$response = json_decode($responseRaw);
		$errorNo  = json_last_error();
		$message  = json_last_error_msg();
		// printre(array($responseRaw, $error, $message));
		if($errorNo != 0) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.$fromMethod
				,'The JSON returned is invalid.  ERROR['.$errorNo.']: '
				,$message
				,'RESPONSE:'
				,$responseRaw
			)));
		}

		return $response;
	}
}
