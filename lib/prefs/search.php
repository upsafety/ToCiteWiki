<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: search.php 48287 2013-10-31 22:28:34Z jonnybradley $

function prefs_search_list()
{
	global $prefs;
	return array (
		'search_parsed_snippet' => array(
			'name' => tra('Parse the results'),
			'hint' => tra('May impact performance'),
			'type' => 'flag',
			'default' => 'y',
		),
		'search_default_where' => array(
			'name' => tra('Default where'),
			'description' => tra('When object filter is not on, limit to search one type of object'),
			'type' => 'multicheckbox',
			'options' => isset($prefs['feature_search_fulltext']) && $prefs['feature_search_fulltext'] === 'y' ?
					array(
						'' => tra('Entire site'),
						'wikis' => tra('Wiki Pages'),
						'trackers' => tra('Trackers'),
					) : array(
						'' => tra('Entire site'),
						'wiki page' => tra('Wiki Pages'),
						'blog post' => tra('Blog Posts'),
						'article' => tra('Articles'),
						'file' => tra('Files'),
						'forum post' => tra('Forums'),
						'trackeritem' => tra('Tracker Items'),
						'sheet' => tra('Spreadsheets'),
					),
			'default' => array(),
		),
		'search_default_interface_language' => array(
			'name' => tra('Restrict search language by default'),
			'description' => tra('If enabled, only search content in the interface language, otherwise show language menu.'),
			'type' => 'flag',
			'default' => 'n',
		),
		'search_autocomplete' => array(
			'name' => tra('Autocomplete on page names'),
			'type' => 'flag',
			'dependencies' => array('feature_jquery_autocomplete', 'javascript_enabled'),
			'warning' => tra('deprecated'),
			'default' => 'n',
		),
		'search_show_category_filter' => array(
			'name' => tra('Category filter'),
			'type' => 'flag',
			'default' => 'n',
		),
		'search_show_tag_filter' => array(
			'name' => tra('Tag filter'),
			'type' => 'flag',
			'default' => 'n',
		),
		'search_show_sort_order' => array(
			'name' => tra('Sort Order'),
			'type' => 'flag',
			'default' => 'n',
		),
		'search_use_facets' => array(
			'name' => tra('Use facets for default search interface'),
			'description' => tra('Facets are dynamic filters generated by the search engine to refine the search results. The feature may not be supported for all search engines.'),
			'type' => 'flag',
			'default' => 'n',
		),
	);
}
