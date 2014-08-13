<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: allowmsg.php 44444 2013-01-05 21:24:24Z changi67 $

function prefs_allowmsg_list()
{
	return array(
		'allowmsg_by_default' => array(
			'name' => tra('Users accept internal messages by default'),
			'description' => tra('if set, Users accept internal messages by default'),
			'type' => 'flag',
			'dependencies' => array(
				'feature_messages',
			),
			'default' => 'y',
		),
		'allowmsg_is_optional' => array(
			'name' => tra('Users can opt-out of internal messages'),
			'description' => tra('if set, Users can opt-out of internal messages'),
			'type' => 'flag',
			'dependencies' => array(
				'feature_messages',
			),
			'default' => 'y',
		),
	);
}
