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
namespace BlazePHP\Authenticate;


/**
 * connMySQL
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class File extends \BlazePHP\Struct
{
	private $fileLoc;
	private $fileHandle;
	private $users;
	private $lastError = null;
	private $errors;

	public function __construct()
	{
		return true;
	}

	private function saveUsers()
	{
		$swpFileLoc = $this->fileLoc.'.swp';
		try {
			$swpFileHandle = fopen($swpFileLoc, 'w');
		}
		catch(\Exception $e) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - Unable to create a swap file for saving users ['.$swpFileLoc.'].  ERROR: '.$e->getMessage()
			)));
		}

		try {
			foreach($this->users as $username => $user) {
				$line = implode(':', array(
					 $user->username
					,$user->password_sha1
					,base64_encode($user->note)
				));
				fwrite($swpFileHandle, $line."\n");
			}

			fclose($swpFileHandle);

			copy($swpFileLoc, $this->fileLoc);
		}
		catch(\Exception $e) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - An error occured while trying to save the users to the destination file from the swap file. ERROR: '.$e->getMessage()
			)));
		}

		unlink($swpFileLoc);

		return true;
	}

	public function setFileLoc($fileLoc)
	{
		if(!file_exists($fileLoc)) {
			if(!touch($fileLoc)) {
				throw new Exception( implode(' ', array(
					 __CLASS__.'::'.__FUNCTION__
					,' - Cannot create the authentication file ['.$fileLoc.']'
				)));
			}
		}
		$this->fileLoc = $fileLoc;
		$usersRaw      = file($fileLoc);
		$users         = array();
		foreach($usersRaw as $userLine) {
			$user                         = new \stdClass();
			$userData                     = explode(':', $userLine);
			$user->username               = $userData[0];
			$user->password_sha1          = (isset($userData[1])) ? $userData[1] : null;
			$user->note                   = (isset($userData[2])) ? base64_decode($userData[2]) : null;
			$this->users[$user->username] = $user;
		}

		return true;
	}

	public function getLastError()
	{
		return $this->lastError;
	}

	public function login($username, $password)
	{
		if(!$this->checkUserExists($username)) {
			$this->lastError = 'Username ['.$username.'] is invalid.';
			$this->errors[]  = $this->lastError;
			return false;
		}

		if(sha1($password) === $this->users[$username]->password_sha1) {
			return true;
		}
		else {
			$this->lastError = 'The login attempt was not successful.';
			$this->errors[]  = 'The login attempt was not successful. (username:['.$username.'], password:['.$password.']';
			return false;
		}
	}

	public function checkUserExists($username)
	{
		return isset($this->users[$username]);
	}


	public function createUser($username, $password, $note)
	{
		if(!preg_match('/^[a-zA-Z0-9_\-\@\.]+$/', $username)) {
			$this->lastError = 'The username ['.$username.'] is invalid.  Allowed characters are (a-z A-Z 0-9 _ - @ .)';
			$this->errors[] = $this->lastError;
			return false;
		}

		if(isset($this->users[$username])) {
			$this->lastError = 'The username ['.$username.'] already exists.';
			$this->errors[]  = $this->lastError . __CLASS__.'::'.__FUNCTION__.'('.$username.', ######, '.$note.')';
			return false;
		}

		$this->users[$username]                = new \stdClass();
		$this->users[$username]->username      = $username;
		$this->users[$username]->password_sha1 = sha1($password);
		$this->users[$username]->note          = $note;

		return $this->saveUsers();
	}

	public function deleteUser($username)
	{
		if(!$this->checkUserExists($username)) {
			$this->lastError = 'The username ['.$username.'] does not exist.';
			$this->errors[]  = $this->lastError . __CLASS__.'::'.__FUNCTION__.'('.$username.')';
			return false;
		}

		$userList    = $this->users;
		$this->users = array();
		foreach($userList as $user) {
			if($user->username !== $username) {
				$this->users[$user->username] = $user;
			}
		}

		return $this->saveUsers();
	}

	public function getUserNote($username)
	{
		if(!$this->checkUserExists($username)) {
			$this->lastError = 'The username ['.$username.'] does not exist.';
			$this->errors[]  = $this->lastError . __CLASS__.'::'.__FUNCTION__.'('.$username.')';
			return false;
		}

		return $this->users[$username]->note;
	}
}