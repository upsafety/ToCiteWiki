<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: NotFoundException.php 46537 2013-07-04 13:07:26Z lphuberdeau $

class Search_Elastic_NotFoundException extends Search_Elastic_Exception
{
	function __construct($type, $id)
	{
		parent::__construct(tr('Document not found in index %1 (%0)', $type, $id));
	}
}

