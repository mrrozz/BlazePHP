<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2024, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2024, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
namespace BlazePHP\Bloogle\ServiceAccount;
use BlazePHP\Globals as G;
use BlazePHP\Session as S;
use \Google\Client as GClient;

/**
 * Runtime
 *
 * @author    Matt Roszyk <matt@roszyk.com>
 * @package   Blaze.Core
 *
 */
class Client
{
	protected $client;

	public function __construct()
	{
		$this->client = new GClient();
		if(empty(G::$env->googleServiceAccountCredsFile) || !file_exists(G::$env->googleServiceAccountCredsFile)) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - Cannot create a Google Client without a Service Account credentials file.'
			)));
		}
		$this->client->setAuthConfig(G::$env->googleServiceAccountCredsFile);
	}
}
