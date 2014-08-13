<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_networkcondition.php 44444 2013-01-05 21:24:24Z changi67 $

function wikiplugin_networkcondition_info()
{
	return array(
		'name' => tr('Network condition'),
		'documentation' => 'PluginNetworkCondition',
		'description' => tr('Conditionally display content based on network information.'),
		'prefs' => array('wikiplugin_networkcondition'),
		'icon' => 'img/icons/computer.png',
		'body' => tr('Content to display conditionally.'),
		'params' => array(
			'ipv4list' => array(
				'required' => false,
				'name' => tra('IPv4 List'),
				'description' => tra("Comma separated list of IPv4 addresses to match against the visitor's address."),
				'default' => '',
				'filter' => 'text',
				'separator' => ',',
				
			),
		),
	);
}

function wikiplugin_networkcondition($data, $params)
{
	global $tikilib;
	
	$ip = $tikilib->get_ip_address();

	if (! empty($params['ipv4list'])) {
		$list = $params['ipv4list'];
		if (! is_array($list)) {
			$list = explode(',', $params['ipv4list']);
		}

		if (! in_array($ip, $list)) {
			return '';
		}
	}

	return $data;
}
