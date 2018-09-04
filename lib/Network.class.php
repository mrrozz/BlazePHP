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
use BlazePHP\Debug   as D;

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
	public static function GET(GETParameters $parameters)
	{
		return self::requestSingle('GET', $parameters);
	}



	/**
	 * POST - Single post requests
	 *
	 * @param $parameters POSTParameter
	 * @return The response data plus the connection info
	 */
	public static function POST(POSTParameters $parameters)
	{
		return self::requestSingle('POST', $parameters);
	}


	/**
	 * POSTJSON - Single POSTJSON requests
	 *
	 * @param $parameters POSTJSONParameter
	 * @return The response data plus the connection info
	 */
	public static function POSTJSON(POSTJSONParameters $parameters)
	{
		return self::requestSingle('POSTJSON', $parameters);
	}



	/*
	 * GET_multi - Execute multiple parallel URL requests
	 *
	 * @param $parameterList array An array of GETParamters objects containing the various requests' information
	 * /
	public static function GETMulti(array $parameterList)
	{
		foreach($parameterList as $p) {
			$type = gettype($p);
			$class = ($type === 'object') ? get_class($p) : 'n/a';
			if($type !== 'object' || $class !== 'BlazePHP\GETParameters') {
				throw new \Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,' - One of the values found within $parameterList is not a valid GETParameters object instance: type['.$type.'], class['.$class.']'
				)));
			}
		}

		return self::requestMulti($parameterList);
	}
	/**/

	/*
	 * POST_multi - Execute multiple parallel URL requests
	 *
	 * @param $parameterList array An array of POSTParamters objects containing the various requests' information
	 * /
	public static function POSTMulti(array $parameterList)
	{
		foreach($parameterList as $p) {
			$type = gettype($p);
			$class = ($type === 'object') ? get_class($p) : 'n/a';
			if($type !== 'object' || $class !== 'BlazePHP\POSTParameters') {
				throw new \Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,' - One of the values found within $parameterList is not a valid POSTParameters object instance: type['.$type.'], class['.$class.']'
				)));
			}
		}

		return self::requestMulti($parametersList);
	}
	/**/


	/**
	 * requestSingle - Single posts/get requests
	 *
	 * @param $type string
	 * @param $p RequestParameters
	 * @return The response data plus the optional connection info
	 */
	//public static function POST($URL, $postFields=null, $responseJSON=true, $withInfo=false)
	private static function requestSingle($type, RequestParameters $p)
	{
		$ch = curl_init();

		$options = array(
			 CURLOPT_URL                  => $p->URL
			,CURLOPT_HEADER               => 0
			,CURLOPT_RETURNTRANSFER       => 0
			,CURLOPT_IPRESOLVE            => CURL_IPRESOLVE_V4
			,CURLOPT_DNS_USE_GLOBAL_CACHE => 0
			,CURLOPT_FILETIME             => 0
			,CURLOPT_FOLLOWLOCATION       => 0
			,CURLOPT_FORBID_REUSE         => 1
			,CURLOPT_FRESH_CONNECT        => 0
			,CURLOPT_HEADER               => 0
			,CURLINFO_HEADER_OUT          => 0
			,CURLOPT_NETRC                => 1
			,CURLOPT_FAILONERROR          => false
			,CURLOPT_CONNECTTIMEOUT       => $p->timeout
		);

		if($type === 'POST') {
			$p->postFields = ($p->postFields !== null) ? http_build_query($p->postFields) : null;
			$options[CURLOPT_POSTFIELDS] = $p->postFields;
			$options[CURLOPT_POST]       = 1;
			$p->headers[] = 'Content-Length: '.(string)strlen($p->postFields);
		}
		else if($type === 'POSTJSON') {
			$options[CURLOPT_POSTFIELDS] = $p->postJSON;
			$options[CURLOPT_POST]       = 1;
			$p->headers[] = 'Content-Length: '.(string)strlen($p->postJSON);
			$p->headers[] = 'Content-Type: application/json';
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

		ob_start();
		curl_exec($ch);
		$response = ob_get_contents();
		ob_end_clean();

		if (curl_errno($ch) !== 0) {
			M::error(
				 __CLASS__.'::'.__FUNCTION__.' - curl has returned an error: '.curl_error($ch)
			);
		}
		$responseInfo = ($p->returnInfo === true) ? curl_getinfo($ch) : null;
		curl_close($ch);

		if ($p->responseJSON === true) {
			return array('info' => $responseInfo, 'data' => json_decode($response));
		}
		else {
			return array('info' => $responseInfo, 'data' => $response);
		}
	}




	/*
 	 * This doesn't work with PHP7.0 for some reason...  Will revisit soon
	 * /
	public static function requestMulti(array $parameterList)
	{
		foreach($parameterList as $p) {
			$type = gettype($p);
			$class = ($type === 'object') ? get_class($p) : 'n/a';
			if($type !== 'object' || !in_array($class, array('BlazePHP\POSTParameters', 'BlazePHP\GETParameters'))) {
				throw new \Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,' - One of the values found within $parameterList is not a valid (POST/GET)Parameters object instance: type['.$type.'], class['.$class.']'
				)));
			}
		}

		$parametersByCall = array();
		$count = 0;
		foreach($parameterList as $p) {

			${'ch'.(string)$count}                 = curl_init();
			$parametersByCall['ch'.(string)$count] = $p;

			if($p->getType() === 'GET') {
				curl_setopt_array(
					${'ch'.(string)$count}, array(
						CURLOPT_URL => $p->URL
					   ,CURLOPT_HEADER => 0
					   ,CURLOPT_RETURNTRANSFER => 1
					   ,CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
					   ,CURLOPT_DNS_USE_GLOBAL_CACHE => 0
					   ,CURLOPT_FILETIME => 0
					   ,CURLOPT_FOLLOWLOCATION => 0
					   ,CURLOPT_FORBID_REUSE => 1
					   ,CURLOPT_FRESH_CONNECT => 0
					   ,CURLOPT_HEADER => 0
					   ,CURLINFO_HEADER_OUT => 0
					   ,CURLOPT_HTTPGET => 1
					   ,CURLOPT_NETRC => 1
					   ,CURLOPT_CONNECTTIMEOUT => $p->timeout
					)
				);
			}
			else if ($p->getType() === 'POST') {
				curl_setopt_array(
					${'ch'.(string)$count}, array(
						CURLOPT_URL => $p->URL
					   ,CURLOPT_HEADER => 0
					   ,CURLOPT_RETURNTRANSFER => 1
					   ,CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
					   ,CURLOPT_DNS_USE_GLOBAL_CACHE => 0
					   ,CURLOPT_FILETIME => 0
					   ,CURLOPT_FOLLOWLOCATION => 0
					   ,CURLOPT_FORBID_REUSE => 1
					   ,CURLOPT_FRESH_CONNECT => 0
					   ,CURLOPT_HEADER => 0
					   ,CURLINFO_HEADER_OUT => 0
					   ,CURLOPT_POST => 1
					   ,CURLOPT_NETRC => 1
					   ,CURLOPT_CONNECTTIMEOUT => $p->timeout
					   ,CURLOPT_POSTFIELDS => http_build_query($p->postFields)
					)
				);
			}

			$count++;

		}

		// Create the multi cURL handle
		$mh = curl_multi_init();

		// Add the  handles
		for ($i=0; $i<$count; $i++) {
			// printre(array($mh, ${'ch'.(string)$i}));
			curl_multi_add_handle($mh, ${'ch'.(string)$i});
			// printr(${'ch'.(string)$i});
		}

		// Execute the handles and wait for the (loop while it's still running)
		$active = null;
		do {
			$mrc = curl_multi_exec($mh, $active);
			// printr(array($mrc, CURLM_CALL_MULTI_PERFORM, CURLM_OK, $active, $mh));
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($active && $mrc == CURLM_OK) {
			// printr(curl_multi_select($mh));
			if (curl_multi_select($mh) != -1) {
				do {
					$mrc = curl_multi_exec($mh, $active);
					printr(array(__LINE__ => $mrc));
					if ($mrc !== CURLM_OK) {
						M::error(
							__CLASS__.'::'.__FUNCTION__.' - curl_exec_multi has returned an error: '.curl_error(${'ch'.(string)$i})
							.' [MRC CODE: '.(string)$mrc.']'
						);
					}
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
		}

		// Wait for the  the content for each
		$r = array();
		for ($i=0; $i<$count; $i++) {
			if (curl_errno(${'ch'.(string)$i}) !== 0) {
				M::error(
					__CLASS__.'::'.__FUNCTION__.' - curl has returned an error: '.curl_error(${'ch'.(string)$i})
				);
				continue;
			}

			$responseInfo = curl_getinfo(${'ch'.(string)$i});
			if ((integer)$responseInfo['http_code'] >= 400 || (integer)$responseInfo['http_code'] <= 0) {
				$response = 'HTTP Error Code: '.(string)$responseInfo['http_code'];
			}
			else {
				$response = curl_multi_getcontent(${'ch'.(string)$i});
			}

			curl_close(${'ch'.(string)$i});

			if ($parametersByCall['ch'.(string)$i]->responseJSON === true) {
				$response = json_decode($response);
			}

			$r[$parametersByCall['ch'.(string)$i]->URL] = array(
				 'info' => ($parametersByCall['ch'.(string)$i]->returnInfo === true) ? $responseInfo : null
				,'data' => $response
			);
		}

		printr($r);

		return $r;
	}
	/**/




	public static function makeParameters($type)
	{
		$type = strtoupper($type);

		if(!in_array($type, array('POST', 'POSTJSON', 'GET'))) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The parameters object ['.(string)$type.'] does not exists'
			);
		}

		if($type === 'POST') {
			return new POSTParameters();
		}
		elseif($type === 'POSTJSON') {
			return new POSTJSONParameters();
		}
		elseif($type === 'GET') {
			return new GETParameters();
		}

	}



	public static function downloadFileHTTP($httpFileLocation, $destinationLocation)
	{
		if(!file_exists(dirname($destinationLocation))) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The destination directory does not exist ['.dirname($destinationLocation).']'
			);
		}
		if(!is_dir(dirname($destinationLocation))) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The destination directory specified is not a directory ['.dirname($destinationLocation).']'
			);
		}
		$destinationFile = fopen($destinationLocation, 'w');

		if(!filter_var($httpFileLocation, FILTER_VALIDATE_URL)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The source URL specified is not valid ['.$httpFileLocation.']'
			);
		}

		$options = array(
			 CURLOPT_RETURNTRANSFER => 1
			,CURLOPT_FILE    => $destinationFile
			,CURLOPT_TIMEOUT => 28800 // set this to 8 hours so we dont timeout on big files
			,CURLOPT_URL     => $httpFileLocation
		);

		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		if($response === false) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The download was not successful: '.curl_error($ch)
			);
		}
		curl_close($ch);

		return true;
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

	public $timeout       = 1; // seconds
	public $headers       = array();

	public $logfile       = null;

	protected $type       = null;

	public function getType()
	{
		return $this->type;
	}
}

class GETParameters extends RequestParameters
{
	protected $type = 'GET';
}

class POSTParameters extends RequestParameters
{
	public  $postFields = null;

	protected $type       = 'POST';
}

class POSTJSONParameters extends RequestParameters
{
	public $postJSON = null;

	protected $type  = 'POSTJSON';
}
