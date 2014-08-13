<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Round.php 48285 2013-10-31 22:01:37Z lphuberdeau $

class Math_Formula_Function_Round extends Math_Formula_Function
{
	function evaluate( $element )
	{
		$elements = array();

		if (count($element) > 2) {
			$this->error(tr('Too many arguments on round.'));
		}

		foreach ( $element as $child ) {
			$elements[] = $this->evaluateChild($child);
		}


		$number = array_shift($elements);
		$decimals = intval(array_shift($elements));

		return round($number, $decimals);
	}
}

