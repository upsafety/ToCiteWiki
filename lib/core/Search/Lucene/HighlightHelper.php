<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: HighlightHelper.php 47248 2013-08-24 08:43:15Z changi67 $

class Search_Lucene_HighlightHelper implements Zend_Filter_Interface
{
	private $query;
	private $snippetHelper;

	function __construct($query)
	{
		$qstr = $query->__toString();									// query needs the object_type field removing for highlighting
		$qstr = preg_replace('/\+?\(\(object_type.*?\)\)/', '', $qstr);	// this is the only way i can find to remove a term form a query
		$query = Zend_Search_Lucene_Search_QueryParser::parse($qstr, 'UTF-8');	// rebuild
		$this->query = $query;
		$this->snippetHelper = new Search_ResultSet_SnippetHelper;
	}

	function filter($content)
	{
		$content = $this->snippetHelper->filter($content);
		return trim(strip_tags($this->query->highlightMatches($content, 'UTF-8'), '<b><i><em><strong><pre><code><span>'));
	}
}

