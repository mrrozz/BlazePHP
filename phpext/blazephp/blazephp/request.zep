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

/**
 * Request - Handles the detailed information about a reqeust
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Request
{
	protected parameters = [];

	public function __construct()
	{
		var name, value;
		// foreach(_REQUEST as name => value) {
		for name, value in _REQUEST {
			let this->parameters[name] = value;
		}
	}


	public function __get(name)
	{
		return (isset(this->parameters[name])) ? this->parameters[name] : null;
	}


	public function getMethod()
	{
		return (isset(_SERVER["REQUEST_METHOD"])) ? strtoupper(_SERVER["REQUEST_METHOD"]) : null;
	}


	public function getRequestedPath()
	{
		return this->parameters["__requested_path"];
	}


	public function getHostConfig()
	{
		var httphost;
		let httphost = (isset(_SERVER["HTTP_HOST"])) ? strtolower(_SERVER["HTTP_HOST"]) : "default";
		return preg_replace("/[^a-z]/", "", httphost);
	}


	public function isPOST()
	{
		return (isset(_SERVER["REQUEST_METHOD"]) && strtoupper(_SERVER["REQUEST_METHOD"]) === "POST")
			? true
			: false;
	}


	public function isGET()
	{
		return (isset(_SERVER["REQUEST_METHOD"]) && strtoupper(_SERVER["REQUEST_METHOD"]) === "GET")
			? true
			: false;
	}


	public function isPUT()
	{
		return (isset(_SERVER["REQUEST_METHOD"]) && strtoupper(_SERVER["REQUEST_METHOD"]) === "PUT")
			? true
			: false;
	}


	public function isDELETE()
	{
		return (isset(_SERVER["REQUEST_METHOD"]) && strtoupper(_SERVER["REQUEST_METHOD"]) === "DELETE")
			? true
			: false;
	}


	public function isAJAX()
	{
		return (array_key_exists("HTTP_X_REQUESTED_WITH", _SERVER) && _SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest");
	}

	public function getAJAXData()
	{
		return json_decode(file_get_contents("php://input"));
	}
}
