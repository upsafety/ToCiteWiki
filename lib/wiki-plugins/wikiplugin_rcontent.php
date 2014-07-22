<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_rcontent.php 44444 2013-01-05 21:24:24Z changi67 $

function wikiplugin_rcontent_info()
{
	return array(
		'name' => tra('Random Dynamic Content'),
		'documentation' => 'PluginRcontent',
		'description' => tra('Display pre-programmed changing content'),
		'prefs' => array( 'feature_dynamic_content', 'wikiplugin_rcontent' ),
		'icon' => 'img/icons/database_table.png',
		'params' => array(
			'id' => array(
				'required' => true,
				'name' => tra('Content ID'),
				'description' => tra('Numeric value representing the content ID'),
				'default' => '',
			)
		)
	);
}

function wikiplugin_rcontent( $data, $params )
{

	$dcslib = TikiLib::lib('dcs');

	$lang = null;
	if ( isset( TikiLib::lib('parser')->option['language'] ) ) {
		$lang = TikiLib::lib('parser')->option['language'];
	}

	if ( $params['id'] )
		return $dcslib->get_random_content((int) $params['id'], $lang);
}
