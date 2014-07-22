<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.service.php 44444 2013-01-05 21:24:24Z changi67 $

function smarty_function_service($params, $smarty)
{
	$servicelib = TikiLib::lib('service');
	$smarty->loadPlugin('smarty_modifier_escape');

	if (! isset($params['controller'])) {
		return 'missing-controller';
	}

	$url = $servicelib->getUrl($params);
	return smarty_modifier_escape($url);
}

