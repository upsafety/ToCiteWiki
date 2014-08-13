<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: smarty.php 47966 2013-10-10 18:43:43Z jonnybradley $

function prefs_smarty_list()
{
	return array(
		'smarty_notice_reporting' => array(
			'name' => tra('Include smarty notices in PHP error report'),
			'description' => tra('In most cases, smarty notices can be safely ignored. However, they may be useful in the development process when strange issues occur.'),
			'type' => 'flag',
			'default' => 'n',
		),
		'smarty_security' => array(
			'name' => tra('Smarty Security'),
			'description' => tra('Do not allow php code in smarty templates.'),
			'warning' => tra('You should leave this on unless you know what you are doing.'),
			'type' => 'flag',
			'perspective' => false,
			'default' => 'y',
		),
		'smarty_security_modifiers' => array(
			'name' => tr('Extra smarty modifiers'),
			'description' => tr('Make additional PHP functions available as smarty modifiers. May be needed for custom templates.'),
			'warning' => tr('There may be security implications. Make sure you know what you are doing.'),
			'type' => 'text',
			'separator' => ',',
			'perspective' => false,
			'default' => '',
			'dependencies' => array(
				'smarty_security',
			),
		),
		'smarty_security_functions' => array(
			'name' => tr('Extra smarty functions'),
			'description' => tr('Make additional PHP functions available as smarty functions. May be needed for custom templates.'),
			'warning' => tr('There may be security implications. Make sure you know what you are doing.'),
			'type' => 'text',
			'separator' => ',',
			'perspective' => false,
			'default' => '',
			'dependencies' => array(
				'smarty_security',
			),
		),
		'smarty_security_dirs' => array(
			'name' => tr('Extra smarty directories'),
			'description' => tr('Make additional dirs available as smarty dirs. May be needed for custom icons (clear temp/cache after changing).'),
			'warning' => tr('There may be security implications. Make sure you know what you are doing.'),
			'type' => 'text',
			'separator' => ',',
			'perspective' => false,
			'default' => '',
			'dependencies' => array(
				'smarty_security',
			),
		),
		'smarty_compilation' => array(
			'name' => tra('Smarty Compilation'),
			'description' => tra('Indicates when the template cache should be refreshed.'),
			'type' => 'list',
			'options' => array(
				'modified' => tra('Modified'),
				'never' => tra('Never check (performance)'),
				'always' => tra('Always (development, slow)'),
			),
			'default' => 'modified',
		),
		'smarty_cache_perms' => array(
			'name' => tra('Smarty cache permissions'),
			'description' => tra('Permissions smarty writes to templates_c with.'),
			'type' => 'list',
			'options' => array(
				0644 => tra('User writable (0644)'),
				0664 => tra('User & group writable (0664)'),
			),
			'default' => 0644,
		),
	);
}
