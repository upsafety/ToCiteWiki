<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: header.php 44444 2013-01-05 21:24:24Z changi67 $

function prefs_header_list()
{
	return array(
		'header_shadow_start' => array(
			'name' => tra('Header shadow start'),
            'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		),
		'header_shadow_end' => array(
			'name' => tra('Header shadow end'),
            'description' => tra(''),
			'type' => 'textarea',
			'size' => '2',
			'default' => '',
		),
		'header_custom_css' => array(
			'name' => tra('Custom CSS'),
			'description' => tra('Includes a custom block of CSS inline in all pages.'),
			'type' => 'textarea',
			'size' => 5,
			'default' => '',
			'filter' => 'none',
		),
		'header_custom_js' => array(
			'name' => tra('Custom JavaScript'),
			'description' => tra('Includes a custom block of inline JavaScript in all pages.'),
			'type' => 'textarea',
			'size' => 5,
			'default' => '',
			'hint' => tra('Do not include the <script> and </script> tags.'),
			'filter' => 'none',
		),
	);	
}
