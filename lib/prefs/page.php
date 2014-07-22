<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: page.php 50225 2014-03-06 10:53:33Z xavidp $

function prefs_page_list()
{
	return array(
		'page_bar_position' => array(
			'name' => tra('Wiki buttons'),
			'description' => tra('Page description, icons, backlinks, ...'),
			'type' => 'list',
			'options' => array(
				'top' => tra('Top '),
				'bottom' => tra('Bottom'),
				'none' => tra('Neither'),
			),
			'default' => 'bottom',
		),
		'page_n_times_in_a_structure' => array(
			'name' => tra('Pages can re-occur in structure'),
            'description' => tra('A page can occur multiple times in a structure'),
			'type' => 'flag',
			'default' => 'n',
		),
	);
}
