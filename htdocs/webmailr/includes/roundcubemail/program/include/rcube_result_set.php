<?php

/*
 +-----------------------------------------------------------------------+
 | program/include/rcube_result_set.php                                  |
 |                                                                       |
 | This file is part of the RoundCube Webmail client                     |
 | Copyright (C) 2006-2010, RoundCube Dev. - Switzerland                 |
 | Licensed under the GNU GPL                                            |
 |                                                                       |
 | PURPOSE:                                                              |
 |   Class representing an address directory result set                  |
 |                                                                       |
 +-----------------------------------------------------------------------+
 | Author: Thomas Bruederli <roundcube@gmail.com>                        |
 +-----------------------------------------------------------------------+

 $Id: rcube_result_set.php,v 1.1 2011/08/01 19:22:12 eldy Exp $

*/


/**
 * RoundCube result set class.
 * Representing an address directory result set.
 *
 * @package Addressbook
 */
class rcube_result_set
{
	var $count = 0;
	var $first = 0;
	var $current = 0;
	var $records = array();


	function __construct($c = 0, $f = 0)
	{
		$this->count = (int) $c;
		$this->first = (int) $f;
	}

	function add($rec)
	{
		$this->records[] = $rec;
	}

	function iterate()
	{
		return $this->records[$this->current++];
	}

	function first()
	{
		$this->current = 0;
		return $this->records[$this->current++];
	}

	// alias for iterate()
	function next()
	{
		return $this->iterate();
	}

	function seek($i)
	{
		$this->current = $i;
	}
}
