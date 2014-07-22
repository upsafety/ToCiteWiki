<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: admin_namespace.php 48912 2013-12-02 21:33:02Z arildb $

require_once('lib/wizard/wizard.php');

/**
 * The Wizard's namespace handler 
 */
class AdminWizardNamespace extends Wizard 
{
	function pageTitle ()
	{
		return tra('Set up Namespace');
	}
	function isEditable ()
	{
		return true;
	}
	function isVisible ()
	{
		global	$prefs;
		return $prefs['namespace_enabled'] === 'y';
	}

	function onSetupPage ($homepageUrl) 
	{
		global	$smarty, $prefs;

		// Run the parent first
		parent::onSetupPage($homepageUrl);

		if (!$this->isVisible()) {
			return false;
		}

		// Only show "hide namespace in structures" option, if structures are active
		$isStructures = isset($prefs['feature_wiki_structure']) && $prefs['feature_wiki_structure'] === 'y' ? true : false;
		$smarty->assign('isStructures', $isStructures);
		
		// Assign the page tempalte
		$wizardTemplate = 'wizard/admin_namespace.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return true;
	}

	function onContinue ($homepageUrl) 
	{
		// Run the parent first
		parent::onContinue($homepageUrl);
	}
}