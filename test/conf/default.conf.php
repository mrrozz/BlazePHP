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
use \BlazePHP\Globals as G;

require_once(__DIR__.'/_common.conf.php');

date_default_timezone_set('America/Chicago');

class DatabaseConfig
{
	public $load_data_config = true;

	public function __construct()
	{
		$this->test_mysql = new \stdClass();
		$this->test_mysql->master = \BlazePHP\Database\ConnectionBoss::build('MySQL');
		$this->test_mysql->master->type     = 'mysql';
		$this->test_mysql->master->hostname = 'vm2';
		$this->test_mysql->master->port     = '3306';
		$this->test_mysql->master->username = 'blazephp_test';
		$this->test_mysql->master->password = '7ab137bb326243729eeae3aabf0c6086';
		$this->test_mysql->master->database = 'blazephp_test_db';
		$this->test_mysql->slave =& $this->test_mysql->master;


		$this->test_postgres = new \stdClass();
		$this->test_postgres->master = \BlazePHP\Database\ConnectionBoss::build('Postgres');
		$this->test_postgres->master->type     = 'postgres';
		$this->test_postgres->master->hostname = 'vm2';
		$this->test_postgres->master->port     = '5432';
		$this->test_postgres->master->username = 'blazephp_test';
		$this->test_postgres->master->password = '7ab137bb326243729eeae3aabf0c6086';
		$this->test_postgres->master->database = 'blazephp_test_db';
		$this->test_postgres->slave =& $this->test_postgres->master;
	}
}

G::$db = new DatabaseConfig();

G::$env = new EnvironmentCommon();
