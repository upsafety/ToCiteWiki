<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: mod-func-featured_links.php 44444 2013-01-05 21:24:24Z changi67 $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/**
 * @return array
 */
function module_featured_links_info()
{
	return array(
		'name' => tra('Featured Links'),
		'description' => tra('Displays the site\'s first featured links.'),
		'prefs' => array('feature_featuredLinks'),
		'documentation' => 'Module featured_links',
		'params' => array(),
		'common_params' => array('nonums', 'rows')
	);
}

/**
 * @param $mod_reference
 * @param $module_params
 */
function module_featured_links($mod_reference, $module_params)
{
	global $tikilib, $smarty;
	
	$smarty->assign('featuredLinks', $tikilib->get_featured_links($mod_reference['rows']));
}
