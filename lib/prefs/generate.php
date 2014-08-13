<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: generate.php 44444 2013-01-05 21:24:24Z changi67 $

function prefs_generate_list()
{
	return array(
		'generate_password' => array(
			'name' => tra('Generate Password'),
            'description' => tra('Include "Generate Password" option on registration form'),
			'type' => 'flag',
			'default' => 'n',
		),
	);	
}
