<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Interface.php 45904 2013-05-10 14:29:56Z lphuberdeau $

interface Tiki_Profile_Transport_Interface
{
	function getPageContent($pageName);

	function getPageParsed($pageName);
}

