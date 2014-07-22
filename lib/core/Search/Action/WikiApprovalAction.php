<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: WikiApprovalAction.php 45248 2013-03-21 16:09:59Z lphuberdeau $

class Search_Action_WikiApprovalAction implements Search_Action_Action
{
	function getValues()
	{
		return array(
			'object_type' => true,
			'object_id' => true,
			'wiki_approval_state' => true,
		);
	}

	function validate(JitFilter $data)
	{
		$object_type = $data->object_type->text();
		$object_id = $data->object_id->pagename();
		$state = $data->wiki_approval_state->alpha();

		if ($object_type != 'wiki page') {
			return false;
		}

		if ($state != 'pending') {
			return false;
		}

		$flaggedrevisionlib = TikiLib::lib('flaggedrevision');
		if (! $flaggedrevisionlib->page_requires_approval($object_id)) {
			return false;
		}

		return true;
	}

	function execute(JitFilter $data)
	{
		$tikilib = TikiLib::lib('tiki');
		$pageName = $data->object_id->pagename();
		$info = $tikilib->get_page_info($pageName);

		$flaggedrevisionlib = TikiLib::lib('flaggedrevision');
		$flaggedrevisionlib->flag_revision($pageName, $info['version'], 'moderation', 'OK');

		return true;
	}
}

