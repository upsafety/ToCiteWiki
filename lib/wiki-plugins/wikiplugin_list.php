<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_list.php 48301 2013-11-01 15:08:12Z nkoth $

function wikiplugin_list_info()
{
	return array(
		'name' => tra('List'),
		'documentation' => 'PluginList',
		'description' => tra('Create lists of Tiki objects based on custom search criteria and formatting'),
		'prefs' => array('wikiplugin_list', 'feature_search'),
		'body' => tra('List configuration information'),
		'filter' => 'wikicontent',
		'profile_reference' => 'search_plugin_content',
		'icon' => 'img/icons/text_list_bullets.png',
		'tags' => array( 'basic' ),
		'params' => array(
		),
	);
}

function wikiplugin_list($data, $params)
{
	$unifiedsearchlib = TikiLib::lib('unifiedsearch');

	$query = new Search_Query;
	$unifiedsearchlib->initQuery($query);

	$matches = WikiParser_PluginMatcher::match($data);

	$builder = new Search_Query_WikiBuilder($query);
	$builder->enableAggregate();
	$builder->apply($matches);

	if (!empty($_REQUEST['sort_mode'])) {
		$query->setOrder($_REQUEST['sort_mode']);
	}

	if (! $index = $unifiedsearchlib->getIndex()) {
		return '';
	}

	$result = $query->search($index);

	$paginationArguments = $builder->getPaginationArguments();

	$resultBuilder = new Search_ResultSet_WikiBuilder($result);
	$resultBuilder->setPaginationArguments($paginationArguments);
	$resultBuilder->apply($matches);

	$builder = new Search_Formatter_Builder;
	$builder->setPaginationArguments($paginationArguments);
	$builder->apply($matches);

	$formatter = $builder->getFormatter();
	$formatter->setDataSource($unifiedsearchlib->getDataSource());
	$out = $formatter->format($result);

	return $out;
}

