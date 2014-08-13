<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: admin_advanced.php 48875 2013-12-01 19:23:46Z arildb $

require_once('lib/wizard/wizard.php');

/**
 * Set up the wiki settings
 */
class AdminWizardAdvanced extends Wizard 
{
    function pageTitle ()
    {
        return tra('Set up some advanced options');
    }
    function isEditable ()
	{
		return true;
	}
	
	public function onSetupPage ($homepageUrl) 
	{
		global	$smarty, $prefs;

		// Run the parent first
		parent::onSetupPage($homepageUrl);

		// Assign the page temaplte
		$wizardTemplate = 'wizard/admin_advanced.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return true;		
	}

	public function onContinue ($homepageUrl) 
	{
		global $tikilib; 

		// Run the parent first
		parent::onContinue($homepageUrl);
		
		// Configure detail preferences in own page
	}
}
