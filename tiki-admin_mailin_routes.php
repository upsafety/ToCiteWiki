<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-admin_mailin_routes.php 46451 2013-06-24 20:30:58Z arildb $

require_once ('tiki-setup.php');
include_once ('lib/mailin/usermailinlib.php');

//check if feature is on
$access->check_feature('feature_mailin');
$access->check_permission(array('tiki_p_admin_mailin'));

$structlib = TikiLib::lib('struct');

// Route display
$userStructs = $usermailinlib->list_all_user_mailin_struct(false);
$smarty->assign('userStructs', $userStructs['data']);


// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');
$smarty->assign('mid', 'tiki-admin_mailin_routes.tpl');
$smarty->display('tiki.tpl');
