<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: admin_files.php 48912 2013-12-02 21:33:02Z arildb $

require_once('lib/wizard/wizard.php');

/**
 * Set up the file and file gallery settings
 */
class AdminWizardFiles extends Wizard 
{
    function pageTitle ()
    {
        return tra('Set up File Gallery & Attachments');
    }
	function isEditable ()
	{
		return true;
	}
	
	function onSetupPage ($homepageUrl) 
	{
		global	$smarty, $prefs;

		// Run the parent first
		parent::onSetupPage($homepageUrl);

		// Assign the page temaplte
		$wizardTemplate = 'wizard/admin_files.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return true;		
	}

	function onContinue ($homepageUrl) 
	{
		global $tikilib, $prefs;
		
		// Run the parent first
		parent::onContinue($homepageUrl);
		
		// If ElFinder is selected, set additional preferences
		if ($prefs['fgal_elfinder_feature'] === 'y') {
			
			// jQuery UI
			$tikilib->set_preference('feature_jquery_ui', 'y');
		}
	}
}


