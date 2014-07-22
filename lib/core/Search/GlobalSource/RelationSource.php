<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: RelationSource.php 48041 2013-10-16 19:30:22Z nkoth $

class Search_GlobalSource_RelationSource implements Search_GlobalSource_Interface
{
	private $relationlib;

	function __construct()
	{
		$this->relationlib = TikiLib::lib('relation');
	}

	function getProvidedFields()
	{
		return array(
			'relations',
			'relation_types',
		);
	}

	function getGlobalFields()
	{
		return array();
	}

	function getData($objectType, $objectId, Search_Type_Factory_Interface $typeFactory, array $data = array())
	{

		if (isset($data['relations']) || isset($data['relation_types'])) {
			return array();
		}

		$relations = array();

		$types = array();

		$from = $this->relationlib->get_relations_from($objectType, $objectId);
		foreach ($from as $rel) {
			$relations[] = Search_Query_Relation::token($rel['relation'], $rel['type'], $rel['itemId']);
			$types[] = $rel['relation'];
		}

		$to = $this->relationlib->get_relations_to($objectType, $objectId);
		foreach ($to as $rel) {
			$relations[] = Search_Query_Relation::token($rel['relation'] . '.invert', $rel['type'], $rel['itemId']);
			$types[] = $rel['relation'] . '.invert';
		}

		return array(
			'relations' => $typeFactory->multivalue($relations),
			'relation_types' => $typeFactory->multivalue(array_unique($types)),
		);
	}
}

