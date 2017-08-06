<?php
namespace BlazeTest;
use BlazePHP\Globals as G;
use BlazePHP\Database\ConnectionBoss;
use BlazePHP\Database\connMySQL;
use BlazeTest\TestCase;


final class Database_1_ConnectionBossTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(ConnectionBoss::class, new ConnectionBoss());
	}


	public function testMysqlConnectionCreation()
	{
		$this->assertInstanceOf(connMySQL::class, ConnectionBoss::build('MySQL'));
	}


	public function testMysqlCreateBlazephpTestDb()
	{
		$this->assertInstanceOf(connMySQL::class, G::$db->test_mysql->master);

		try {
			$db = G::$db->test_mysql->master;
			$database = $db->database;
			$db->database = null;

			$sql = 'CREATE DATABASE `'.$database.'`';
			$db->query($sql);
			G::$db->test_mysql->master->database = $database;
		}
		catch(\Exception $e) {
			G::$db->test_mysql->master->database = $database;
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,$e->getMessage()
				,$sql
			)));
		}
	}

	public function testMysqlCreateTable()
	{
		$db   = G::$db->test_mysql->master;
		// printre($db);

		$sql = array();
		$sql[] = 'CREATE TABLE `test_a` (';
		$sql[] = '  `id`   int(11) not null primary key auto_increment';
		$sql[] = ' ,`name` varchar(20) default null';
		$sql[] = ' ,`created` timestamp default current_timestamp';
		$sql[] = ') ENGINE=InnoDB;';

		$result = $db->query(implode(' ', $sql));
	}

	public function testMysqlListTables()
	{
		$db = G::$db->test_mysql->master;
		$tables = $db->listTables();
		$this->assertArray($tables);
		$this->assertArrayNotEmpty($tables);
	}


	public function testMysqlDescTable()
	{
		$db = G::$db->test_mysql->master;
		$tables = $db->listTables();
		$this->assertArray($tables);
		$this->assertArrayNotEmpty($tables);
		foreach($tables as $table) {
			$description = $db->descTable($table);
			foreach($description as $column => $info) {
				$this->assertNotEmpty($description[$column]['type']);
			}
		}
	}


	public function testMysqlDropBlazephpTestDb()
	{
		$db = G::$db->test_mysql->master;
		$sql = 'DROP DATABASE `'.$db->database.'`';

		try {
			$db->query($sql);
		}
		catch(\Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,$e->getMessage()
				,$sql
			)));
		}
	}


	public function testPostgresConnectionCreation()
	{
		$this->assertInstanceOf(\BlazePHP\Database\connPostgres::class, ConnectionBoss::build('Postgres'));
	}

	public function testPostgresCreateBlazephpTestDb()
	{
		$this->assertInstanceOf(\BlazePHP\Database\connPostgres::class, G::$db->test_postgres->master);

		$sql = 'CREATE DATABASE blazephp_test_db OWNER=blazephp_test';

		try {
			$db = G::$db->test_postgres->master;
			$db->database = 'postgres'; // This is required for all connections to a postgres server
			$db->query($sql);
			// $db->database = $database;
		}
		catch(\Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,$e->getMessage()
				,$sql
			)));
		}
	}

	public function testPostgresConnectionHash()
	{
		$db   = G::$db->test_postgres->master;
		$hash = $db->connectionHash();
		$db->database = 'blazephp_test_db';
		$this->assertTrue($db->connect());
		$hashNew = $db->connectionHash();
		$this->assertTrue($hash !== $hashNew);
	}

	public function testPostgresCreateTable()
	{
		$db   = G::$db->test_postgres->master;

		$sql = array();
		$sql[] = 'CREATE TABLE "test_a" (';
		$sql[] = '  "id"   serial primary key not null';
		$sql[] = ' ,"name" varchar(20) default null';
		$sql[] = ' ,"created" timestamp without time zone default current_timestamp';
		$sql[] = ');';

		$result = $db->query(implode(' ', $sql));
	}

	public function testPostgresTransactionCommit()
	{
		$db = G::$db->test_postgres->master;

		$this->assertTrue($db->begin());
		$sql = 'INSERT INTO "test_a" ("name") VALUES('.$db->quote("John Smith").')';
		$result = $db->query($sql);
		$this->assertResource($result);
		$this->assertTrue($db->commit());
	}


	public function testPostgresTransactionRecordCount()
	{
		$db = G::$db->test_postgres->slave;

		$sql = 'SELECT * FROM "test_a"';
		$result = $db->query($sql);
		$this->assertResource($result);
		$row = pg_fetch_row($result);
		$this->assertTrue(($row[1] === 'John Smith'));
	}


	public function testPostgresTransactionRollback()
	{
		$db = G::$db->test_postgres->slave;

		$this->assertTrue($db->begin());
		$sql = 'DELETE FROM "test_a"';
		$result = $db->query($sql);
		$this->assertResource($result);
		$this->assertTrue($db->rollback());
	}


	public function testPostgresRecordCountAfterRollback()
	{
		$this->testPostgresTransactionRecordCount();
	}

	public function testPostgresListTables()
	{
		$db = G::$db->test_postgres->master;
		$tables = $db->listTables();
		$this->assertArray($tables);
		$this->assertArrayNotEmpty($tables);
	}

	public function testPostgresDescTable()
	{
		$db = G::$db->test_postgres->master;
		$tables = $db->listTables();
		$this->assertArray($tables);
		$this->assertArrayNotEmpty($tables);
		foreach($tables as $table) {
			$description = $db->descTable($table);
			$this->assertArray($description);
			$this->assertArrayNotEmpty($description);
			foreach($description as $column => $info) {
				$this->assertNotEmpty($description[$column]['type']);
				// $this->assertBoolean($description[$column]['is_nullable']);
			}
		}
	}


	public function testPostgresDropBlazephpTestDb()
	{
		$db = G::$db->test_postgres->master;
		$db->database = 'postgres';
		$sql = 'DROP DATABASE blazephp_test_db';

		try {
			$db->query($sql);
		}
		catch(\Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,$e->getMessage()
				,$sql
			)));
		}
	}


}
