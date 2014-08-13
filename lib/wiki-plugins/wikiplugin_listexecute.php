<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: wikiplugin_listexecute.php 48301 2013-11-01 15:08:12Z nkoth $

function wikiplugin_listexecute_info()
{
	return array(
		'name' => tra('List Execute'),
		'documentation' => 'PluginListExecute',
		'description' => tra('Generates a list of objects based on a set of filters and allows to execute configured actions on them.'),
		'prefs' => array('wikiplugin_listexecute', 'feature_search'),
		'body' => tra('List configuration information'),
		'validate' => 'all',
		'filter' => 'wikicontent',
		'profile_reference' => 'search_plugin_content',
		'icon' => 'img/icons/text_list_bullets.png',
		'tags' => array( 'advanced' ),
		'params' => array(
		),
	);
}

function wikiplugin_listexecute($data, $params)
{
	$unifiedsearchlib = TikiLib::lib('unifiedsearch');

	$actions = array();

	$factory = new Search_Action_Factory;
	$factory->register(
		array(
			'change_status' => 'Search_Action_ChangeStatusAction',
			'delete' => 'Search_Action_Delete',
			'email' => 'Search_Action_EmailAction',
			'wiki_approval' => 'Search_Action_WikiApprovalAction',
			'tracker_item_modify' => 'Search_Action_TrackerItemModify',
		)
	);

	$query = new Search_Query;
	$unifiedsearchlib->initQuery($query);

	$matches = WikiParser_PluginMatcher::match($data);

	$builder = new Search_Query_WikiBuilder($query);
	$builder->apply($matches);

	foreach ($matches as $match) {
		$name = $match->getName();

		if ($name == 'action') {
			$action = $factory->fromMatch($match);

			if ($action && $action->isAllowed(Perms::get()->getGroups())) {
				$actions[$action->getName()] = $action;
			}
		}
	}

	if (!empty($_REQUEST['sort_mode'])) {
		$query->setOrder($_REQUEST['sort_mode']);
	}

	$index = $unifiedsearchlib->getIndex();

	$result = $query->search($index);

	$plugin = new Search_Formatter_Plugin_SmartyTemplate('templates/wiki-plugins/wikiplugin_listexecute.tpl');

	$paginationArguments = $builder->getPaginationArguments();

	$dataSource = $unifiedsearchlib->getDataSource();
	$builder = new Search_Formatter_Builder;
	$builder->setPaginationArguments($paginationArguments);
	$builder->apply($matches);
	$builder->setFormatterPlugin($plugin);

	$formatter = $builder->getFormatter();
	$formatter->setDataSource($dataSource);

	$reportSource = new Search_GlobalSource_Reporting;

	if (isset($_POST['list_action'], $_POST['objects'])) {
		$action = $_POST['list_action'];
		$objects = (array) $_POST['objects'];

		if (isset($actions[$action])) {
			$tx = TikiDb::get()->begin();

			$action = $actions[$action];
			$plugin->setFields(array_fill_keys($action->getFields(), null));
			$list = $formatter->getPopulatedList($result);

			foreach ($list as $entry) {
				$identifier = "{$entry['object_type']}:{$entry['object_id']}";
				if (in_array($identifier, $objects) || in_array('ALL', $objects)) {
					$success = $action->execute($entry);

					$reportSource->setStatus($entry['object_type'], $entry['object_id'], $success);
				}
			}

			$tx->commit();
		}
	}

	$plugin = new Search_Formatter_Plugin_SmartyTemplate('templates/wiki-plugins/wikiplugin_listexecute.tpl');
	$plugin->setFields(array('report_status' => null));
	$plugin->setData(
		array(
			'actions' => array_keys($actions),
		)
	);
	$dataSource = new Search_Formatter_DataSource_Declarative;
	$dataSource->addGlobalSource($reportSource);

	$formatter = new Search_Formatter($plugin);
	$formatter->setDataSource($dataSource);
	return $formatter->format($result);
}

