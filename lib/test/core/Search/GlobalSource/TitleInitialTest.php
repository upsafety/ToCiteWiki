<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: TitleInitialTest.php 47853 2013-10-02 14:03:06Z lphuberdeau $

class Search_GlobalSource_TitleInitialTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider mapping
	 */
	function testTitlePresent($letter, $string)
	{
		$factory = new Search_Type_Factory_Direct;
		$source = new Search_GlobalSource_TitleInitialSource;
		$out = $source->getData(null, null, $factory, array(
			'title' => $factory->sortable($string),
		));

		$this->assertEquals($factory->identifier($letter), $out['title_initial']);
	}

	function mapping()
	{
		return array(
			'basic' => array('H', 'Hello World'),
			'lowercase' => array('H', 'hello world'),
			'vowel' => array('E', 'End'),
			'missing' => array('0', ''),
			'accentuated' => array('E', 'éducation'),
		);
	}
}

