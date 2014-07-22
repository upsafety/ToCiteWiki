<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_objectlink.php 46007 2013-05-20 18:34:12Z lphuberdeau $

function wikiplugin_objectlink_info()
{
	return array(
		'name' => tra('Object Link'),
		'description' => tra('Displays a link to an object in the system.'),
		'prefs' => array('wikiplugin_objectlink'),
		'icon' => 'img/icons/world_link.png',
		'tags' => array( 'basic' ),
		'format' => 'html',
		'inline' => true,
		'params' => array(
			'type' => array(
				'required' => true,
				'name' => tr('Type'),
				'description' => tr('The object type'),
				'type' => 'text',
			),
			'id' => array(
				'required' => true,
				'name' => tra('Object ID'),
				'description' => tra('The item to display'),
				'filter' => 'text',
				'profile_reference' => 'type_in_param',
			),
		),
	);
}

function wikiplugin_objectlink($data, $params)
{
	$smarty = TikiLib::lib('smarty');
	$smarty->loadPlugin('smarty_function_object_link');

	return smarty_function_object_link(
		array(
			'type' => $params['type'],
			'id' => $params['id'],
		),
		$smarty
	);
}

