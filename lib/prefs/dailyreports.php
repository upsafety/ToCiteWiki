<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: dailyreports.php 44444 2013-01-05 21:24:24Z changi67 $

function prefs_dailyreports_list()
{
	return array(
		'dailyreports_enabled_for_new_users' => array(
			'name' => tr('Enable daily reports for new users'),
            'description' => tra('Determines if daily reports will be automatically enabled for new Users. Default is "no".'),
			'type' => 'flag',
			'default' => 'n',
			'help' => 'Daily+Reports',
			'tags' => array('basic','tiki reporting feature'),
		),
	);
}
