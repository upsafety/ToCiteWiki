<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: admin_text_area.php 48912 2013-12-02 21:33:02Z arildb $

require_once('lib/wizard/wizard.php');

/**
 * Set up the wiki settings
 */
class AdminWizardTextArea extends Wizard 
{
    function pageTitle ()
    {
        return tra('Set up Text Area');
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

		$showPage = true;

		// Mark that Wysiwyg HTML mode is used
		if ((isset($prefs['feature_wysiwyg']) && $prefs['feature_wysiwyg'] === 'y') &&
			(!isset($prefs['wysiwyg_htmltowiki']) || $prefs['wysiwyg_htmltowiki'] === 'n')) {
			$smarty->assign('isHtmlMode', true);
		} else  {
			$smarty->assign('isHtmlMode', false);
		}

		// Hide Codemirror for RTL languages, since it doesn't work
		require_once('lib/language/Language.php');
		$isRTL = Language::isRTL();
		$smarty->assign('isRTL', $isRTL);

		// Assign the page temaplte
		$wizardTemplate = 'wizard/admin_text_area.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return $showPage;		
	}

	public function onContinue ($homepageUrl) 
	{
		global $tikilib; 

		// Run the parent first
		parent::onContinue($homepageUrl);
		
		// Configure detail preferences in own page
	}
}
