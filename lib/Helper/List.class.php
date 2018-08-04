<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2015, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2015, BlazePHP.com
 * @link          http://blazePHP.com
 * @package       Blaze.
 */



class ListHelper
{

	public $name;

	public $page             = 1;
	public $pageLast;
	public $pageLines;
	public $pageLinesDefault = 25;
	public $pageLinesMax     = 100;
	public $pageListSpan     = 10;

	public $totalLines = 0;

	public $orderBy;
	public $orderDir;
	public $orderByDefault  = 'id';
	public $orderDirDefault = 'asc';





	public function __construct($name, &$model=null)
	{
		if(empty($name)) {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - A list must have a name'
			);
		}
		else if($model !== null && (!is_object($model) || !method_exists($model, 'isAttribute'))) {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - The value passed in for the model is not valid or the isAttibute() method does not exist'
			);
		}

		$this->name = $name;

		if($model !== null) {
			if(  !empty(G::$router->params[$this->name.'-orderBy'])
			  && $model->isAttribute(G::$router->params[$this->name.'-orderBy']))
			{
				$this->orderBy = G::$router->params[$this->name.'-orderBy'];
			}
			else {
				$this->orderBy =& $this->orderByDefault;
			}
		}
		else {
			if(!empty(G::$router->params[$this->name.'-orderBy'])) {
				$this->orderBy = G::$router->params[$this->name.'-orderBy'];
			}
			else {
				$this->orderBy =& $this->orderByDefault;
			}
		}

		if(  !empty(G::$router->params[$this->name.'-orderDir'])
		  && in_array(G::$router->params[$this->name.'-orderDir'], array('asc', 'desc')))
		{
			$this->orderDir = G::$router->params[$this->name.'-orderDir'];
		}
		else {
			$this->orderDir =& $this->orderDirDefault;
		}


		if(!empty(G::$router->params[$this->name.'-page'])) {
			$this->page = (integer)G::$router->params[$this->name.'-page'];
			$this->page = ($this->page <= 0) ? 1 : $this->page;
		}

		if(!empty(G::$router->params[$this->name.'-pageLines'])) {
			$this->pageLines = (integer)G::$router->params[$this->name.'-pageLines'];
			$this->pageLines = ($this->pageLines <= 0) ? $this->pageLinesDefault : $this->pageLines;
			$this->pageLines = ($this->pageLines > $this->pageLinesMax)
				? $this->pageLinesMax
				: $this->pageLines;
		}
		else {
			$this->pageLines =& $this->pageLinesDefault;
		}
	}





	public function totalLines($count)
	{
		$this->totalLines = $count;
		$this->pageLast   = ceil(($this->totalLines / $this->pageLines));

		if(($this->page * $this->pageLines) > $this->totalLines) {
			$this->page = $this->pageLast;
		}
	}





	public function urlOriginalSort($name, $parameters=null)
	{
		$sort = array(
			 $this->name.'-orderBy'  => $name
			,$this->name.'-orderDir' => 'asc'
		);
		if($this->orderBy == $name) {
			$sort[$this->name.'-orderDir'] = ($this->orderDir === 'asc') ? 'desc' : 'asc';
		}
		if(!is_array($parameters)) {
			$parameters = $sort;
		}
		else {
			$parameters = array_merge($sort, $parameters);
		}
		return G::$router->urlOriginal($parameters);
	}





	private function urlOriginalPage($adjustment, $parameters=null)
	{
		$totalPages = ceil($this->totalLines / $this->pageLines);
		if($adjustment === 'previous') {
			$newPage = ($this->page > 1) ? ($this->page -1) : 1;
		}
		else if($adjustment === 'next') {
			$newPage = ($this->page < $totalPages) ? ($this->page + 1) : $this->page;
		}
		else if($adjustment === 'last') {
			$newPage = ($totalPages > 0) ? $totalPages : 1;
		}
		else if($adjustment === 'first') {
			$newPage = 1;
		}
		else if(is_integer($adjustment)) {
			$newPage = $adjustment;
		}
		else {
			throw new Exception(
				__CLASS__.'::'.__FUNCTION__.' - Invalid page adjustment received ['.$adjustment.']'
			);
		}
		$page = array(
			 $this->name.'-page'      => $newPage
			,$this->name.'-pageLines' => $this->pageLines
		);

		if(!is_array($parameters)) {
			$parameters = $page;
		}
		else {
			$parameters = array_merge($pageParameters, $parameters);
		}

		return G::$router->urlOriginal($parameters);
	}





	public function urlOriginalPageNext($parameters=null) {
		return self::urlOriginalPage('next', $parameters);
	}





	public function urlOriginalPagePrevious($parameters=null) {
		return self::urlOriginalPage('previous', $parameters);
	}





	public function urlOriginalPageLast($parameters=null) {
		return self::urlOriginalPage('last', $parameters);
	}





	public function urlOriginalPageFirst($parameters=null) {
		return self::urlOriginalPage('first', $parameters);
	}





	public function pageList($parameters=null)
	{
		$pagePadding = floor($this->pageListSpan / 2);

		$pageEnd = ($this->page + $pagePadding > $this->pageLast)
			? $this->pageLast
			: ($this->page + $pagePadding);

		$pageStart = (($pageEnd - $this->pageListSpan) <= 0)
			? 1
			: ($pageEnd - $this->pageListSpan);

		if($pageEnd < $this->pageLast && ($pageStart + $this->pageListSpan) < ($this->pageLast + $pagePadding)) {
			$pageEnd = $pageStart + $this->pageListSpan;
		}

		$pageEnd = ($pageEnd > $this->pageLast) ? $this->pageLast : $pageEnd;

		$pageList = array();
		for($page = $pageStart; $page <= $pageEnd; $page++) {
			$pageList[$page] = self::urlOriginalPage((integer)$page, $parameters);
		}

		return $pageList;
	}






















}