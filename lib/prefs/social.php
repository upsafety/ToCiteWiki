<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: social.php 47001 2013-08-06 16:58:48Z lphuberdeau $

function prefs_social_list()
{
	return array(
		'social_network_type' => array(
			'name' => tra('Social Network Type'),
			'description' => tra('Select how the friendship relations within the social network should be treated.'),
			'type' => 'list',
			'options' => array(
				'follow' => tr('Follow (as in Twitter)'),
				'friend' => tr('Friend (as in Facebook)'),
				'follow_approval' => tr('Followers need approval'),
			),
			'default' => 'follow',
		),
	);
}
