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
 * @copyright     2012 - 2023, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
namespace BlazePHP\Bloogle\ServiceAccount;
use BlazePHP\Debug as D;
use \Google\Service\Drive as GDrive;

/**
 * Runtime
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Drive extends Client
{
	private $drive;
	private $workingDirID = null;

	public function __construct()
	{
		parent::__construct();
		$this->client->setScopes(['https://www.googleapis.com/auth/drive']);
		$this->drive = new GDrive($this->client);
	}


	public function cwd($workingDirID)
	{
		$this->workingDirID = $workingDirID;
	}


	public function mkdir($dirName)
	{
		try {
			// Check to see if the directory already exists
			// Google will just duplicate it, as this is not a real file system
			$query = [
				'q' => "name='".preg_replace('/\"/', '\"', $dirName)."' and '".$this->workingDirID."' in parents"
				,'fields' => 'files(id, name)'
			];
			$response = $this->drive->files->listFiles($query);
            if(count($response->files) > 0) {
            	//
            	// If so, return the ID of that directory
            	//
            	return $response->files[0]->id;
            }

            // Make a new directory if it does not exist
			$dirMeta = new GDrive\DriveFile([
				 'name'     => $dirName
				,'mimeType' => 'application/vnd.google-apps.folder'
				,'parents'  => [$this->workingDirID]
			]);
			$dir = $this->drive->files->create($dirMeta, ['fields' => 'id']);
		}
		catch(Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - There was an error creating dir ['.$dirName.'] under parent ['.$this->workingDirID.']'
			)));
		}

		return $dir->id;
	}


	public function put($fileName, $fileType, $content, $uploadType='multipart')
	{
		try {
			$fileMeta = new GDrive\DriveFile([
				 'name'    => $fileName
				,'parents' => [$this->workingDirID]
			]);

			return $this->drive->files->create($fileMeta, [
				 'data'       => $content
				,'mimeType'   => $fileType
				,'uploadType' => $uploadType
				,'fields'     => 'id'
			]);
		}
		catch(Exception $e) {
			throw new \Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,' - There was an error uploading file ['.$fileName.', '.$fileType.'] under parent ['.$this->workingDirID.']'
			)));
		}
	}
}