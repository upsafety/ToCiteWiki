<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: admin_features.php 48912 2013-12-02 21:33:02Z arildb $

require_once('lib/wizard/wizard.php');

/**
 * The Wizard's namespace handler 
 */
class AdminWizardFeatures extends Wizard 
{
    function pageTitle ()
    {
        return tra('Set up Main features');
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
		
		$isMultiLanguage = $prefs['feature_multilingual'] === 'y';
		if ($isMultiLanguage) {
			$smarty->assign('isMultiLanguage', $isMultiLanguage);
		}
		
		// Assign the page template
		$wizardTemplate = 'wizard/admin_features.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return true;
	}

	function onContinue ($homepageUrl) 
	{
		// Run the parent first
		parent::onContinue($homepageUrl);
	}
}