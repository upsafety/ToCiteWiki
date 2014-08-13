<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: block.activityframe.php 47366 2013-09-06 13:15:03Z lphuberdeau $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"], basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_block_activityframe($params, $content, $smarty, &$repeat)
{
	if ( $repeat ) return;

	$likes = isset($params['activity']['like_list']) ? $params['activity']['like_list'] : array();
	if (! is_array($likes)) {
		$params['activity']['like_list'] = $likes = array();
	}

	if (isset($params['activity']['user_groups'])) {
		$userGroups = TikiLib::lib('user')->get_user_groups($GLOBALS['user']);
		$choiceGroups = TikiLib::lib('user')->get_groups_userchoice();
		$sharedGroups = array_intersect($params['activity']['user_groups'], $userGroups, $choiceGroups);
	} else {
		$sharedGroups = array();
	}

	$smarty = TikiLib::lib('smarty');
	$smarty->assign(
		'activityframe', array(
			'content' => $content,
			'activity' => $params['activity'],
			'heading' => $params['heading'],
			'like' => in_array($GLOBALS['user'], $likes),
			'sharedgroups' => $sharedGroups,
		)
	);
	$out = $smarty->fetch('activity/activityframe.tpl');

	return $out;
}
