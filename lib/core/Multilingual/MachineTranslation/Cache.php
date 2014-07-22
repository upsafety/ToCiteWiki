<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Cache.php 44444 2013-01-05 21:24:24Z changi67 $

 
class Multilingual_MachineTranslation_Cache implements Multilingual_MachineTranslation_Interface
{
	private $handler;
	private $hash;

	function __construct(Multilingual_MachineTranslation_Interface $handler, $hash)
	{
		$this->handler = $handler;
		$this->hash = $hash;
	}

	function getSupportedLanguages()
	{
		return $this->handler->getSupportedLanguages();
	}

	function translateText($text)
	{
		$cachelib = TikiLib::lib('cache');

		if ($result = $cachelib->getCached($text . $this->hash, 'translation')) {
			return $result;
		}

		$result = $this->handler->translateText($text);

		$cachelib->cacheItem($text, $result, 'translation');

		return $result;
	}
}
