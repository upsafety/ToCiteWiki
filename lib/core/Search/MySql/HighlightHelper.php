<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: HighlightHelper.php 47279 2013-08-26 14:48:36Z changi67 $

class Search_MySql_HighlightHelper implements Zend_Filter_Interface
{
	private $words = array();
	private $replacements = array();
	private $snippetHelper;

	function __construct(array $words)
	{
		$this->words = $words;
		$this->replacements = array_map(
			function ($word) {
				return "<b style=\"color:black;background-color:#ff66ff\">$word</b>";
			}, $this->words
		);
		$this->snippetHelper = new Search_ResultSet_SnippetHelper;
	}

	function filter($content)
	{
		$content = $this->snippetHelper->filter($content);
		$content = str_ireplace($this->words, $this->replacements, $content);
		return trim(strip_tags($content, '<b><i><em><strong><pre><code><span>'));
	}
}

