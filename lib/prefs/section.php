<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: section.php 48453 2013-11-15 21:34:57Z jonnybradley $

function prefs_section_list()
{
	return array(
		'section_comments_parse' => array(
			'name' => tra('Parse wiki syntax in comments'),
			'type' => 'flag',
			'help' => 'Wiki+Syntax',
			'description' => tra('Parse wiki syntax in comments in all sections apart from Forums') . '<br>' .
							 tra('Use "Accept wiki syntax" for forums in admin forums page'),
			'default' => 'y',		// parse wiki markup on comments in all sections
		),
	);
}
