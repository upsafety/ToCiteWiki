<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: RuleSet.php 46592 2013-07-08 15:06:13Z lphuberdeau $

class Tiki_Event_Customizer_RuleSet
{
	private $parser;
	private $rules = array();

	function __construct()
	{
		$this->parser = new Math_Formula_Parser;
	}

	function addRule($function)
	{
		$this->rules[] = $this->parser->parse($function);
	}

	function getRules()
	{
		return $this->rules;
	}
}

