<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: IncrementalUpdateTest.php 46982 2013-08-03 18:29:06Z lphuberdeau $

/**
 * @group unit
 */
abstract class Search_Lucene_IncrementalUpdateTest extends Search_Index_IncrementalUpdateTest
{
	private $dir;

	function setUp()
	{
		$this->dir = dirname(__FILE__) . '/test_index';
		$this->tearDown();

		$index = $this->getIndex();
		$this->populate($index);
	}

	function tearDown()
	{
		$this->getIndex()->destroy();
	}

	protected function getIndex()
	{
		return new Search_Lucene_Index($this->dir);
	}
}
