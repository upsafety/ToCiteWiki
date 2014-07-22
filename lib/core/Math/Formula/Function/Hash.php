
<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Hash.php 47015 2013-08-07 14:34:06Z lphuberdeau $

class Math_Formula_Function_Hash extends Math_Formula_Function
{
	function evaluate( $element )
	{
		$parts = array();

		foreach ($element as $child) {
			$component = $this->evaluateChild($child);
			$parts = array_merge($parts, (array) $component);
		}

		return sha1(implode('/', $parts));
	}
}

