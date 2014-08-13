<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Mul.php 44444 2013-01-05 21:24:24Z changi67 $

class Math_Formula_Function_Mul extends Math_Formula_Function
{
	function evaluate( $element )
	{
		$out = 1;

		foreach ( $element as $child ) {
			$out *= $this->evaluateChild($child);
		}

		return $out;
	}
}

