<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: admin_wizard_completed.php 48875 2013-12-01 19:23:46Z arildb $

require_once('lib/wizard/wizard.php');

/**
 * The Wizard's last screen
 */
class AdminWizardCompleted extends Wizard 
{
    function pageTitle ()
    {
        return tra('Admin Wizard Completed!');
    }
    function isEditable ()
	{
		return false;
	}
	
	public function onSetupPage ($homepageUrl) 
	{
		global	$smarty;

		// Run the parent first
		parent::onSetupPage($homepageUrl);
		
		// Assign the page template
		$wizardTemplate = 'wizard/admin_wizard_completed.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return true;
	}

	function onContinue ($homepageUrl) 
	{
		global $tikilib; 

		// Run the parent first
		parent::onContinue($homepageUrl);
	}
}
