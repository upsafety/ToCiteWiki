<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: middle.php 44444 2013-01-05 21:24:24Z changi67 $

function prefs_middle_list()
{
	return array(
		'middle_shadow_start' => array(
			'name' => tra('Middle shadow start'),
            'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		),
		'middle_shadow_end' => array(
			'name' => tra('Middle shadow end'),
            'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		),
	);	
}
