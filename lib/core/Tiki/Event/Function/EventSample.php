<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: EventSample.php 47279 2013-08-26 14:48:36Z changi67 $

class Tiki_Event_Function_EventSample extends Math_Formula_Function
{
	function __construct($recorder)
	{
		$this->recorder = $recorder;
	}

	function evaluate( $element )
	{
		$recorded = $this->evaluateChild($element[0]);
		$event = $this->evaluateChild($element[1]);
		$arguments = $this->evaluateChild($element[2]);

		$this->recorder->setSample(
			$recorded, array(
				'event' => $event,
				'args' => $arguments,
			)
		);

		return 1;
	}
}

