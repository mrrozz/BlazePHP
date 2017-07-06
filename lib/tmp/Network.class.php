<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2015, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2015, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */


/**
 * Network
 *
 * Holds the basic network communication tools
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Network
{

	/**
	 * GET - Single get requests
	 *
	 * @param $p GETParameters
	 * @return The response data plus the connection info
	 */
	public static function GET(GETParameters $p)
	{
		return self::requestSingle('GET', $p);
	}



	/**
	 * POST - Single post requests
	 *
	 * @param $p POSTParameter
	 * @return The response data plus the connection info
	 */
	public static function POST(POSTParameters $p)
	{
		return self::requestSingle('POST', $p);
	}



	/**
	 * requestSingle - Single posts/get requests
	 *
	 * @param $type string
	 * @param $p RequestParameters
	 * @return The response data plus the optional connection info
	 */
	//public static function POST($URL, $postFields=null, $responseJSON=true, $withInfo=false)
	public static function requestSingle($type, RequestParameters $p)
	{
		$ch = curl_init();

		$options = array(
			 CURLOPT_URL                  => $p->URL
			,CURLOPT_HEADER               => 0
			,CURLOPT_RETURNTRANSFER       => 1
			,CURLOPT_IPRESOLVE            => CURL_IPRESOLVE_V4
			,CURLOPT_DNS_USE_GLOBAL_CACHE => 0
			,CURLOPT_FILETIME             => 0
			,CURLOPT_FOLLOWLOCATION       => 0
			,CURLOPT_FORBID_REUSE         => 1
			,CURLOPT_FRESH_CONNECT        => 0
			,CURLOPT_HEADER               => 0
			,CURLINFO_HEADER_OUT          => 0
			,CURLOPT_NETRC                => 1
			,CURLOPT_FAILONERROR          => true
			,CURLOPT_CONNECTTIMEOUT       => $p->timeout
			// ,CURLOPT_SSL_VERIFYHOST       => 0
			// ,CURLOPT_SSL_VERIFYPEER       => false
		);

		if($type === 'POST') {
			$p->postFields = ($p->postFields !== null) ? http_build_query($p->postFields) : null;
			$options[CURLOPT_POSTFIELDS] = $p->postFields;
			$options[CURLOPT_POST]       = 1;
			$p->headers[] = 'Content-Length: '.(string)strlen($p->postFields);
		}
		else if($type === 'GET') {
			$options[CURLOPT_HTTPGET] = 1;
		}

		if($p->verifySSLCert === true) {
			$options[CURLOPT_SSL_VERIFYHOST] = 2;
			$options[CURLOPT_SSL_VERIFYPEER] = true;
		}
		else {
			$options[CURLOPT_SSL_VERIFYHOST] = 2;
			$options[CURLOPT_SSL_VERIFYPEER] = false;
		}

		if(!empty($p->authUsername)) {
			$options[CURLOPT_USERPWD] = $p->authUsername.':'.$p->authPassword;
		}


		if($p->debug === true) {
			$options[CURLOPT_VERBOSE] = true;
			if(!is_null($p->logfile) && is_resource($p->logfile)) {
				$options[CURLOPT_STDERR]  = $p->logfile;
			}
		}

		if(is_array($p->headers) && count($p->headers) > 0) {
			$options[CURLOPT_HTTPHEADER] = $p->headers;
		}

		curl_setopt_array($ch, $options);

		$response = curl_exec($ch);


		if (curl_errno($ch) !== 0) {
			\Message::send(
				 __CLASS__.'::'.__FUNCTION__.' - curl has returned an error: '.curl_error($ch)
				,1
			);
		}
		$responseInfo = ($p->returnInfo === true) ? curl_getinfo($ch) : null;
		curl_close($ch);

		if ($p->responseJSON === true) {
			return Array('info' => $responseInfo, 'data' => json_decode($response));
		}
		else {
			return Array('info' => $responseInfo, 'data' => $response);
		}
	}




	public static function makeParameters($objectName)
	{
		if(class_exists($objectName.'Parameters')) {
			$objectName .= 'Parameters';
			return new $objectName();
		}

		throw new Exception(
			__CLASS__.'::'.__FUNCTION__.' - The parameters object ['.(string)$objectName.'] does not exists'
		);
	}
}



abstract class RequestParameters extends Struct
{
	public $URL           = null;
	public $responseJSON  = true;
	public $returnInfo    = false;
	public $verifySSLCert = false;
	public $authUsername  = null;
	public $authPassword  = null;

	public $debug         = false;

	public $timeout       = 10; // seconds
	public $headers       = array();

	public $logfile       = null;
}

class GETParameters extends RequestParameters {}

class POSTParameters extends RequestParameters
{
	public $postFields = null;
}