<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: user_preferences_notifications.php 49756 2014-02-06 11:13:28Z xavidp $

require_once('lib/wizard/wizard.php');
require_once('lib/notifications/notificationlib.php');
include_once ('lib/userprefs/userprefslib.php');

/**
 * Set up the wysiwyg editor, including inline editing
 */
class UserWizardPreferencesNotifications extends Wizard 
{
	function pageTitle ()
    {
        return tra('User Watches:') . ' ' . tra('Notification Preferences');
    }
    
   	function isEditable ()
	{
		return true;
	}

	function isVisible ()
	{
		global	$prefs;
		return $prefs['feature_user_watches'] === 'y';
	}

	function onSetupPage ($homepageUrl) 
	{
		global	$user, $smarty, $tikilib, $prefs; 

		// Run the parent first
		parent::onSetupPage($homepageUrl);

		$showPage = false;
		
		// Show if option is selected
		if ($prefs['feature_user_watches'] === 'y') {
			$showPage = true;
		}

		// Setup initial wizard screen
		$smarty->assign('user_calendar_watch_editor', $tikilib->get_user_preference($user, 'user_calendar_watch_editor'));
		$smarty->assign('user_article_watch_editor', $tikilib->get_user_preference($user, 'user_article_watch_editor'));
		$smarty->assign('user_wiki_watch_editor', $tikilib->get_user_preference($user, 'user_wiki_watch_editor'));
		$smarty->assign('user_blog_watch_editor', $tikilib->get_user_preference($user, 'user_blog_watch_editor'));
		$smarty->assign('user_tracker_watch_editor', $tikilib->get_user_preference($user, 'user_tracker_watch_editor'));
		$smarty->assign('user_comment_watch_editor', $tikilib->get_user_preference($user, 'user_comment_watch_editor'));

		// Assign the page template
		$wizardTemplate = 'wizard/user_preferences_notifications.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return $showPage;		
	}

	function onContinue ($homepageUrl) 
	{
		global $tikilib, $user, $prefs;
		
		// Run the parent first
		parent::onContinue($homepageUrl);
		
		if (isset($_REQUEST['user_calendar_watch_editor']) && $_REQUEST['user_calendar_watch_editor'] == 'on') {
			$tikilib->set_user_preference($user, 'user_calendar_watch_editor', 'y');
		} else {
			$tikilib->set_user_preference($user, 'user_calendar_watch_editor', 'n');
		}
		
		if (isset($_REQUEST['user_article_watch_editor']) && $_REQUEST['user_article_watch_editor'] == 'on') {
			$tikilib->set_user_preference($user, 'user_article_watch_editor', 'y');
		} else {
			$tikilib->set_user_preference($user, 'user_article_watch_editor', 'n');
		}
		
		if (isset($_REQUEST['user_wiki_watch_editor']) && $_REQUEST['user_wiki_watch_editor'] == 'on') {
			$tikilib->set_user_preference($user, 'user_wiki_watch_editor', 'y');
		} else {
			$tikilib->set_user_preference($user, 'user_wiki_watch_editor', 'n');
		}
		
		if (isset($_REQUEST['user_blog_watch_editor']) && $_REQUEST['user_blog_watch_editor'] == 'on') {
			$tikilib->set_user_preference($user, 'user_blog_watch_editor', 'y');
		} else {
			$tikilib->set_user_preference($user, 'user_blog_watch_editor', 'n');
		}
		
		if (isset($_REQUEST['user_tracker_watch_editor']) && $_REQUEST['user_tracker_watch_editor'] == 'on') {
			$tikilib->set_user_preference($user, 'user_tracker_watch_editor', 'y');
		} else {
			$tikilib->set_user_preference($user, 'user_tracker_watch_editor', 'n');
		}
		
		if (isset($_REQUEST['user_comment_watch_editor']) && $_REQUEST['user_comment_watch_editor'] == 'on') {
			$tikilib->set_user_preference($user, 'user_comment_watch_editor', 'y');
		} else {
			$tikilib->set_user_preference($user, 'user_comment_watch_editor', 'n');
		}

	}
}
