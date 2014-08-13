<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: File.php 45904 2013-05-10 14:29:56Z lphuberdeau $

class Tiki_Profile_Transport_File implements Tiki_Profile_Transport_Interface
{
	private $path;

	function __construct($path, $profileName)
	{
		$this->path = "$path/$profileName";
	}

	function getPageContent($pageName)
	{
		$fullpath = $this->path . '/' . $pageName . '.wiki';
		if (file_exists($fullpath)) {
			return file_get_contents($fullpath);
		}

		return null;
	}

	function getPageParsed($pageName)
	{
		$content = $this->getPageContent($pageName);

		if ($content) {
			return TikiLib::lib('parser')->parse_data($content);
		}
	}
}

