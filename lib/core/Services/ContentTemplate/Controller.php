<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Controller.php 46618 2013-07-10 22:21:55Z arildb $

class Services_ContentTemplate_Controller
{
	function setUp()
	{
		global $prefs;

		if ($prefs['feature_wiki_templates'] != 'y') {
			throw new Services_Exception_Disabled('feature_wiki_templates');
		}
	}
	
	function action_list($input)
	{
		// Validate access
		$access = TikiLib::lib('access');
		$access->check_permission('tiki_p_use_content_templates');
		
		// Load the templates
		require_once ('lib/templates/templateslib.php');
		$templatesLib = new TemplatesLib();
		
		$section = 'wiki';
		$offset = 0;
		$maxRecords = -1;	
		$sort_mode = 'name_asc';
		$find = null;
		
		$contentTmpl = $templatesLib->list_templates($section, $offset, $maxRecords, $sort_mode, $find);
		
		// Build the result		
		$result = array();
		$name = "";
		$content = "";
		foreach ($contentTmpl['data'] as $val) {
			if (count($contentTmpl) > 0) {
				$templateId = $val['templateId'];
				$templateData = $templatesLib->get_template($templateId);
			
				$name = $templateData['name'];
				if (isset($templateData['content'])) {
					$content = $templateData['content'];
				}
			}
			$result[] = array('title' => $name,  'html'=> $content);
		}

		// Done
		return array(
			'data' => $result,
			'cant' => count($result),
			);
	}
}

