<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: contact.php 46033 2013-05-24 16:26:55Z lphuberdeau $

function prefs_contact_list()
{
	return array (
		'contact_anon' => array(
			'name' => tra('Allow anonymous visitors to use the "Contact Us" feature.'),
			'description' => tra('Allow anonymous visitors to use the "Contact Us" feature.'),
			'type' => 'flag',
			'help' => 'Contact+us',
			'dependencies' => array(
				'feature_contact',
			),
			'default' => 'n',
			'tags' => array('basic'),			
		),
		'contact_priority_onoff' => array(
			'name' => tra('Display Contact Priority'),
			'description' => tra('Display Contact Priority option'),
			'type' => 'flag',
			'help' => 'Contact+us',
			'dependencies' => array(
				'feature_contact',
			),
			'default' => 'n',
			'tags' => array('basic'),			
		),
		'contact_user' => array(
			'name' => tra('Contact user'),
			'description' => tra('the user to Contact'),
			'type' => 'text',
			'size' => 40,
			'dependencies' => array(
				'feature_contact',
			),
			'default' => 'admin',
		),
	);
}
