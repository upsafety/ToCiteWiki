<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: multidomain.php 50833 2014-04-19 01:44:17Z jyhem $

function prefs_multidomain_list()
{
	return array(
		'multidomain_active' => array(
			'name' => tra('Multi-domain'),
            'description' => tra('Allows domain names to be mapped to perspectives and simulate multiple domains hosted on the same instance.'),
			'perspective' => false,
			'help' => 'Multi-Domain',
			'type' => 'flag',
			'dependencies' => array(
				'feature_perspective',
			),
			'default' => 'n',
		),
		'multidomain_config' => array(
			'name' => tra('Multi-domain Configuration'),
			'description' => tra('Comma-separated values mapping the domain name to the perspective ID.'),
            'perspective' => false,
			'type' => 'textarea',
			'size' => 10,
			'hint' => tra('One domain per line. Comma separated with perspective ID. Ex.: tiki.org,1'),
			'default' => '',
		),
		'multidomain_switchdomain' => array(
			'name' => tra('Switch domain when switching perspective'),
			'description' => tra('Remember that different domains have different login sessions and even in the case of subdomains you need to have an understanding of session cookies to make it work'),
            'tags' => array('advanced'),
            'type' => 'flag',
			'dependencies' => array(
				'feature_perspective', 'multidomain_active'
			),
			'default' => 'n',
		),
	);
}
