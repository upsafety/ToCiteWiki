<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: pagination.php 44444 2013-01-05 21:24:24Z changi67 $

function prefs_pagination_list()
{
	return array(
		'pagination_firstlast' => array(
			'name' => tra("Display 'First' and 'Last' links"),
            'description' => tra('if set, will display \'first\' and \'last\' links on pages'),
			'type' => 'flag',
			'default' => 'y',
		),
		'pagination_fastmove_links' => array(
			'name' => tra('Display fast move links'),
            'description' => tra('Display fast move links (by 10 percent of the total number of pages) '),
			'type' => 'flag',
			'default' => 'y',
		),
		'pagination_hide_if_one_page' => array(
			'name' => tra('Hide pagination when there is only one page'),
            'description' => tra('Hide pagination on single pages'),
			'type' => 'flag',
			'default' => 'y',
		),
		'pagination_icons' => array(
			'name' => tra('Use Icons'),
            'description' => tra(''),
			'type' => 'flag',
			'default' => 'y',
		),
	);	
}
