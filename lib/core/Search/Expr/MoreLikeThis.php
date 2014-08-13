<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: MoreLikeThis.php 46481 2013-06-26 19:06:45Z lphuberdeau $

class Search_Expr_MoreLikeThis implements Search_Expr_Interface
{
	private $type;
	private $field;
	private $weight;

	function __construct($type, $object)
	{
		$this->type = $type;
		$this->object = $object;
	}

	function setType($type)
	{
	}

	function getType()
	{
		return 'plaintext';
	}

	function setField($field = 'global')
	{
	}

	function setWeight($weight)
	{
	}

	function getWeight()
	{
		return 1;
	}

	function walk($callback)
	{
		return call_user_func($callback, $this, array());
	}

	function getValue(Search_Type_Factory_Interface $typeFactory)
	{
	}

	function getField()
	{
		return $this->field;
	}

	function traverse($callback)
	{
		return call_user_func($callback, $callback, $this, array());
	}

	function getObjectType()
	{
		return $this->type;
	}

	function getObjectId()
	{
		return $this->object;
	}
}

