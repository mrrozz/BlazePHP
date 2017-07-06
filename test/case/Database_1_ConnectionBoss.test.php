<?php
namespace BlazeTest;

use BlazeTest\TestCase;


final class Database_1_ConnectionBossTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Database\ConnectionBoss::class, new \BlazePHP\Database\ConnectionBoss());
	}


	public function testMysqlConnectionCreation()
	{
		$this->assertInstanceOf(\BlazePHP\Database\connMySQL::class, \BlazePHP\Database\ConnectionBoss::build('MySQL'));
	}


	public function testMysqlCreateBlazephpTestDb()
	{
		$this->assertInstanceOf(\BlazePHP\Database\connMySQL::class, \G::$db->test_mysql->master);

		try {
			$db = \G::$db->test_mysql->master;
			$database = $db->database;
			$db->database = null;

			$sql = 'CREATE DATABASE `'.$database.'`';
			$db->query($sql);
			$db->database = $database;

		}
		catch(\Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,$e->getMessage()
				,$sql
			)));
		}
	}


	public function testMysqlDropBlazephpTestDb()
	{
		$db = \G::$db->test_mysql->master;
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
		$this->assertInstanceOf(\BlazePHP\Database\connPostgres::class, \BlazePHP\Database\ConnectionBoss::build('Postgres'));
	}

	public function testPostgresCreateBlazephpTestDb()
	{
		$this->assertInstanceOf(\BlazePHP\Database\connPostgres::class, \G::$db->test_postgres->master);

		$sql = 'CREATE DATABASE blazephp_test_db OWNER=blazephp_test';

		try {
			$db = \G::$db->test_postgres->master;
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
		$db   = \G::$db->test_postgres->master;
		$hash = $db->connectionHash();
		$db->database = 'blazephp_test_db';
		$this->assertTrue($db->connect());
		$hashNew = $db->connectionHash();
		$this->assertTrue($hash !== $hashNew);
	}

	public function testPostgresCreateTable()
	{
		$db   = \G::$db->test_postgres->master;

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
		$db = \G::$db->test_postgres->master;

		$this->assertTrue($db->begin());
		$sql = 'INSERT INTO "test_a" ("name") VALUES('.$db->quote("John Smith").')';
		$result = $db->query($sql);
		$this->assertResource($result);
		$this->assertTrue($db->commit());
	}

	public function testPostgresTransactionRecordCount()
	{
		$db = \G::$db->test_postgres->slave;

		$sql = 'SELECT * FROM "test_a"';
		$result = $db->query($sql);
		$this->assertResource($result);
		$row = pg_fetch_row($result);
		$this->assertTrue(($row[1] === 'John Smith'));
	}


	public function testPostgresTransactionRollback()
	{
		$db = \G::$db->test_postgres->slave;

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


	public function testPostgresDropBlazephpTestDb()
	{
		$db = \G::$db->test_postgres->master;
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
