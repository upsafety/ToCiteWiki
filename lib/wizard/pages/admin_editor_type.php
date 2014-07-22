<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: admin_editor_type.php 48912 2013-12-02 21:33:02Z arildb $

require_once('lib/wizard/wizard.php');

/**
 * The Wizard's editor type selector handler 
 */
class AdminWizardEditorType extends Wizard 
{
    function pageTitle ()
    {
        return tra('Select Editor type');
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
		
		$showPage = true;

		$editorType = isset($prefs['feature_wysiwyg']) && $prefs['feature_wysiwyg'] === 'y' ? 'wysiwyg' : 'text';
		$smarty->assign('editorType', $editorType);
		
		
		// Assign the page tempalte
		$wizardTemplate = 'wizard/admin_editor_type.tpl';
		$smarty->assign('wizardBody', $wizardTemplate);
		
		return $showPage;
	}

	function onContinue ($homepageUrl) 
	{
		global $wizardlib, $tikilib;

		// Run the parent first
		parent::onContinue($homepageUrl);
		
		$editorType = $_REQUEST['editorType'];
		switch ($editorType) {
			case 'text':
				$tikilib->set_preference('feature_wysiwyg', 'n');
				break;
			
			case 'wysiwyg':
				$tikilib->set_preference('feature_wysiwyg', 'y');
				break;
		}
		
	}
}