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
 * @package       Blaze.
 */
namespace BlazeTest;
use \BlazePHP\Controller as C;
use \BlazePHP\Struct;
use \BlazePHP\Debug      as D;
use BlazeTest\TestCase;

define('FILE_AUTH_LOC', __DIR__.'/Authenticate/file.auth');


final class AuthenticateTest extends TestCase
{
	public function testFileAuthInstanceCreates()
	{
		$this->assertInstanceOf(\BlazePHP\Authenticate\File::class, new \BlazePHP\Authenticate\File());
	}

	public function testFileAuthBuildsFromAuthBoss()
	{
		$this->assertInstanceOf(\BlazePHP\Authenticate\File::class, \BlazePHP\Authenticate\AuthenticateBoss::build('File'));
	}

	public function testFileAuthSetsFile()
	{
		$auth    = \BlazePHP\Authenticate\AuthenticateBoss::build('File');
		$fileLoc = FILE_AUTH_LOC;
		$success = $auth->setFileLoc($fileLoc);

		$this->assertTrue($success);
		$this->assertFileExists($fileLoc);

		unlink($fileLoc);
	}

	public function testFileAuthCreateUser()
	{

		$auth    = \BlazePHP\Authenticate\AuthenticateBoss::build('File');
		$fileLoc = FILE_AUTH_LOC;
		$success = $auth->setFileLoc($fileLoc);

		$username = 'testUser1';
		$password = 'testPass';
		$note     = 'test note for #1';
		$success  = $auth->createUser($username, $password, $note);

		$this->assertTrue($success);
	}

	public function testFileAuthLogin()
	{
		$auth    = \BlazePHP\Authenticate\AuthenticateBoss::build('File');
		$fileLoc = FILE_AUTH_LOC;
		$success = $auth->setFileLoc($fileLoc);

		$success = $auth->login('testUser1', 'testPass');

		$this->assertTrue($success);
	}


	public function testFileAuthDeleteUser()
	{
		$auth    = \BlazePHP\Authenticate\AuthenticateBoss::build('File');
		$fileLoc = FILE_AUTH_LOC;
		$success = $auth->setFileLoc($fileLoc);

		$username = 'testUser2';
		$password = 'testPass';
		$note     = 'test note for #2';
		$success  = $auth->createUser($username, $password, $note);

		$username = 'testUser3';
		$password = 'testPass';
		$note     = 'test note for #3';
		$success  = $auth->createUser($username, $password, $note);

		$exists = $auth->checkUserExists('testUser2');
		$this->assertTrue($exists);

		$success = $auth->deleteUser('testUser2');
		$this->assertTrue($success);

		$exists = $auth->checkUserExists('testUser2');
		$this->assertFalse($exists);


	}

	public function testFileAuthGetUserNote()
	{
		$auth    = \BlazePHP\Authenticate\AuthenticateBoss::build('File');
		$fileLoc = FILE_AUTH_LOC;
		$success = $auth->setFileLoc($fileLoc);

		$note = $auth->getUserNote('testUser3');

		$this->assertValueEquals('test note for #3', $note);
	}

	public function testFileAuthCleanup()
	{
		unlink(FILE_AUTH_LOC);
	}
}
