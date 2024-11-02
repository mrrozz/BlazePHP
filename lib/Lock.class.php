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
namespace BlazePHP;


/**
 * Lock
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
// class Lock extends Struct
// {
// 	private $lockFileLocation;
//
// 	public function __construct($procName)
// 	{
// 		$this->lockFileLocation = ABS_VAR.'/lock/'.$procName.'.lock';
//
// 		if(file_exists($this->lockFileLocation)) {
//
// 			$now      = new \DateTime();
// 			$fileTime = new \DateTime(date('Y-m-d H:i:s', filemtime($this->lockFileLocation)));
// 			$diff     = $now->diff($fileTime);
//
// 			$fileAge = implode('', array(
// 				 $diff->d.' days, '
// 				,str_pad((string)$diff->h, 2, '0', STR_PAD_LEFT)
// 				,':'
// 				,str_pad((string)$diff->i, 2, '0', STR_PAD_LEFT)
// 				,':'
// 				,str_pad((string)$diff->s, 2, '0', STR_PAD_LEFT)
// 			));
//
// 			throw new \Exception(
// 				'The lock file exists for ['.$procName.'], age: ['.$fileAge.'], location: ['.$this->lockFileLocation.']'
// 			);
// 		}
// 		else {
// 			$fp = fopen($this->lockFileLocation, 'w');
// 			fwrite($fp, $this->lockFileLocation);
// 			fclose($fp);
// 		}
// 	}
//
// 	public function __destruct()
// 	{
// 		unlink($this->lockFileLocation);
// 	}
//
// 	public function fileLocation()
// 	{
// 		return $this->lockFileLocation;
// 	}
// }
