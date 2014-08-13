<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: TypeAnalyzerTest.php 47248 2013-08-24 08:43:15Z changi67 $

class Search_Elastic_TypeAnalyzerTest extends Search_Index_TypeAnalyzerTest
{
	protected $index;

	function setUp()
	{
		$connection = new Search_Elastic_Connection('http://localhost:9200');
		$connection->startBulk(100);

		$status = $connection->getStatus();
		if (! $status->ok) {
			$this->markTestSkipped('ElasticSearch needs to be available on localhost:9200 for the test to run.');
		}

		$this->index = new Search_Elastic_Index($connection, 'test_index');
		$this->index->destroy();
	}

	protected function getIndex()
	{
		return $this->index;
	}

	function tearDown()
	{
		if ($this->index) {
			$this->index->destroy();
		}
	}
}

