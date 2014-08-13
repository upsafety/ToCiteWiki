<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-map_mode_selector.php 44444 2013-01-05 21:24:24Z changi67 $

if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
	header("location: index.php");
	exit;
}


/**
 * @return array
 */
function module_map_mode_selector_info()
{
	return array(
		'name' => tra('Mode Selector'),
		'description' => tra("Toggle input modes for the map."),
		'prefs' => array(),
		'params' => array(
		),
	);
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_map_mode_selector($mod_reference, $module_params)
{
}

