<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: map.php 44444 2013-01-05 21:24:24Z changi67 $

function prefs_map_list()
{
	return array(
		'map_path' => array(
			'name' => tra('full path to mapfiles'),
            'description' => tra(''),
			'type' => 'text',
			'size' => '50',
			'default' => '',
		),
		'map_help' => array(
			'name' => tra('Wiki Page for Help'),
            'description' => tra(''),
			'type' => 'text',
			'size' => '50',
			'default' => 'MapsHelp',
		),
		'map_comments' => array(
			'name' => tra('Wiki Page for Comments'),
            'description' => tra(''),
			'type' => 'text',
			'size' => '25',
			'default' => 'MapsComments',
		),
	);
}
