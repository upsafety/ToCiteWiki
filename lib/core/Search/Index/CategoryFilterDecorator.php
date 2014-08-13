<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: CategoryFilterDecorator.php 46836 2013-07-25 14:19:46Z lphuberdeau $

class Search_Index_CategoryFilterDecorator extends Search_Index_AbstractIndexDecorator
{
	private $excluded;

	function __construct(Search_Index_Interface $index, array $excluded)
	{
		parent::__construct($index);
		$this->excluded = $excluded;
	}

	function addDocument(array $document)
	{
		if (isset($document['deep_categories'])) {
			if (method_exists($document['deep_categories'], 'getRawValue')) {
				$categories = $document['deep_categories']->getRawValue();
			} else {
				$categories = $document['deep_categories']->getValue();
			}

			if (is_array($categories) && array_intersect($this->excluded, $categories)) {
				return 0;
			}
		}
		return $this->parent->addDocument($document);
	}

	function getIdentifierFields()
	{
		return array_keys(array_filter($this->mapping));
	}
}

