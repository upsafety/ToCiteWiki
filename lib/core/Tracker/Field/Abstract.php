<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: Abstract.php 48921 2013-12-03 04:58:01Z lindonb $

abstract class Tracker_Field_Abstract implements Tracker_Field_Interface, Tracker_Field_Indexable
{
	private $definition;
	private $options;
	private $itemData;
	private $trackerDefinition;

	function __construct($fieldInfo, $itemData, $trackerDefinition)
	{
		$this->options = Tracker_Options::fromSerialized($fieldInfo['options'], $fieldInfo);

		if (! isset($fieldInfo['options_array'])) {
			$fieldInfo['options_array'] = $this->options->buildOptionsArray();
		}

		$this->definition = $fieldInfo;
		$this->itemData = $itemData;
		$this->trackerDefinition = $trackerDefinition;
	}

	public function renderInput($context = array())
	{
		return 'Not implemented';
	}

	public function renderOutput($context = array())
	{
		if ($this->isLink($context)) {
			$itemId = $this->getItemId();
			$query = $_GET;
			unset($query['trackerId']);
			if (isset($query['page'])) {
				$query['from'] = $query['page'];
				unset($query['page']);
			}


			$classList = array('tablename');
			$metadata = TikiLib::lib('object')->get_metadata('trackeritem', $itemId, $classList);

			require_once ('lib/smarty_tiki/modifier.sefurl.php');
			$href = smarty_modifier_sefurl($itemId, 'trackeritem');
			$href .= (strpos($href, '?') === false) ? '?' : '&';
			$href .= http_build_query($query, '', '&');

			$arguments = array(
				'class' => implode(' ', $classList),
				'href' => $href,
			);
			if (!empty($context['url'])) {
				if (strpos($context['url'], 'itemId') !== false) {
					$context['url'] = preg_replace('/([&|\?])itemId=?[^&]*/', '\\1itemId=' . $itemId, $context['url']);
				} elseif (isset($context['reloff']) && strpos($context['url'], 'offset') !== false) {
					global $smarty;
					$context['url'] = preg_replace('/([&|\?])tr_offset=?[^&]*/', '\\1tr_offset' . $smarty->tpl_vars['iTRACKERLIST']
						. '=' . $context['reloff'], $context['url']);
				}
				$arguments['href'] = $context['url'];
			}

			$pre = '<a';
			foreach ($arguments as $key => $value) {
				$pre .= ' ' . $key . '="' . htmlentities($value, ENT_QUOTES, 'UTF-8') . '"';
			}

			if (isset($context['showpopup']) && $context['showpopup'] == 'y') {
				$popup = $this->renderPopup();

				if ($popup) {
					$popup = preg_replace('/<\!--.*?-->/', '', $popup);	// remove comments added by log_tpl
					$popup = preg_replace('/\s+/', ' ', $popup);
					$pre .= " $popup";
				}
			}

			$pre .= $metadata;
			$pre .= '>';
			$post = '</a>';

			return $pre . $this->renderInnerOutput($context) . $post;
		} else {
			return $this->renderInnerOutput($context);
		}
	}

	function watchCompare($old, $new)
	{
		$name = $this->getConfiguration('name');
		$is_visible = $this->getConfiguration('isHidden', 'n') == 'n';

		if (! $is_visible) {
			return;
		}

		if ($old) {
			// split old value by lines
			$lines = explode("\n", $old);
			// mark every old value line with standard email reply character
			$old_value_lines = '';
			foreach ($lines as $line) {
				$old_value_lines .= '> '.$line;
			}
			return "[-[$name]-]:\n--[Old]--:\n$old_value_lines\n\n*-[New]-*:\n$new";
		} else {
			return "[-[$name]-]:\n$new";
		}
	}

	private function isLink($context = array())
	{
		$type = $this->getConfiguration('type');
		if ($type == 'x') {
			return false;
		}

		if ($this->getConfiguration('showlinks', 'y') == 'n') {
			return false;
		}

		if (isset($context['showlinks']) && $context['showlinks'] == 'n') {
			return false;
		}

		if (isset($context['list_mode']) && $context['list_mode'] == 'csv') {
			return false;
		}

		$itemId = $this->getItemId();
		if (empty($itemId)) {
			return false;
		}
		$itemObject = Tracker_Item::fromInfo($this->itemData);

		$status = $this->getData('status');

		if ($this->getConfiguration('isMain', 'n') == 'y'
			&& ($itemObject->canView()	|| $itemObject->getPerm('comment_tracker_items'))
			) {
			return (bool) $this->getItemId();
		}

		return false;
	}

	private function renderPopup()
	{
		$fields = $this->trackerDefinition->getPopupFields();

		if (empty($fields)) {
			return null;
		}

		$factory = $this->trackerDefinition->getFieldFactory();

		$popupFields = array();

		foreach ($fields as $id) {
			$field = $this->trackerDefinition->getField($id);

			if (!isset($this->itemData[$field['fieldId']])) {
				foreach ($this->itemData['field_values'] as $fieldVal) {
					if ($fieldVal['fieldId'] == $id) {
						if (isset($fieldVal['value'])) {
							$this->itemData[$field['fieldId']] = $fieldVal['value'];
						}
					}
				}
			}
			$handler = $factory->getHandler($field, $this->itemData);

			if ($handler) {
				$field = array_merge($field, $handler->getFieldData());
				$popupFields[] = $field;
			}
		}

		$smarty = TikiLib::lib('smarty');
		$smarty->assign('popupFields', $popupFields);
		$smarty->assign('popupItem', $this->itemData);
		return trim($smarty->fetch('trackeroutput/popup.tpl'));
	}

	/**
	 * return the html for the output of a field without link, preprend...
	 * @param
	 * @return html
	 */
	protected function renderInnerOutput($context = array())
	{
		if (isset($context['list_mode']) && $context['list_mode'] === 'csv') {
			$val = $this->getConfiguration('value');
			$default = array('CR'=>'%%%', 'delimitorL'=>'"', 'delimitorR'=>'"');
			$context = array_merge($default, $context);
			$val = str_replace(array("\r\n", "\n", '<br />', $context['delimitorL'], $context['delimitorR']), array($context['CR'], $context['CR'], $context['CR'], $context['delimitorL'].$context['delimitorL'], $context['delimitorR'].$context['delimitorR']), $val);
			return $val;
		} else {
			return $this->getConfiguration('pvalue', $this->getConfiguration('value'));
		}
	}

	/**
	 * Return the HTML id of input tag for this
	 * field in the item form
	 *
	 * @return string
	 */
	protected function getInsertId()
	{
		return 'ins_' . $this->definition['fieldId'];
	}

	protected function getFilterId()
	{
		return 'filter_' . $this->definition['fieldId'];
	}

	protected function getConfiguration($key, $default = false)
	{
		return isset($this->definition[$key]) ? $this->definition[$key] : $default;
	}

	/**
	 * Return the value for this item field
	 *
	 * @param mixed $default the field value used if none is set
	 * @return mixed field value
	 */
	protected function getValue($default = '')
	{
		$key = $this->getConfiguration('fieldId');

		if (isset($this->itemData[$key])) {
			$value = $this->itemData[$key];
		} else if (isset($this->definition['value'])) {
			$value = $this->definition['value'];
		} else if (isset($this->itemData['fields'][$this->getConfiguration('permName')])) {
			$value = $this->itemData['fields'][$this->getConfiguration('permName')];
		} else {
			$value = null;
		}

		return $value === null ? $default : $value;
	}

	protected function getItemId()
	{
		return $this->getData('itemId');
	}

	protected function getData($key, $default = false)
	{
		return isset($this->itemData[$key]) ? $this->itemData[$key] : $default;
	}

	/**
	 * Returns an option from the options array based on the numeric position.
	 * For the list of options for a particular field check its getTypes() method.
	 *
	 * @param int $number
	 * @param bool $default
	 * @return mixed
	 */
	protected function getOption($key, $default = false)
	{
		if (is_numeric($key)) {
			return $this->options->getParamFromIndex($key, $default);
		} else {
			return $this->options->getParam($key, $default);
		}
	}

	protected function getTrackerDefinition()
	{
		return $this->trackerDefinition;
	}

	protected function getItemData()
	{
		return $this->itemData;
	}

	protected function renderTemplate($file, $context = array(), $data = array())
	{
		$smarty = TikiLib::lib('smarty');

		//ensure value is set, because it may not always come from definition
		if (!isset($this->definition['value'])) {
			$this->definition['value'] = $this->getValue();
		}

		$smarty->assign('field', $this->definition);
		$smarty->assign('context', $context);
		$smarty->assign('item', $this->getItemData());
		$smarty->assign('data', $data);

		return $smarty->fetch($file, $file);
	}

	function getDocumentPart(Search_Type_Factory_Interface $typeFactory)
	{
		$baseKey = $this->getBaseKey();
		return array(
			$baseKey => $typeFactory->sortable($this->getValue()),
		);
	}

	function getProvidedFields()
	{
		$baseKey = $this->getBaseKey();
		return array($baseKey);
	}

	function getGlobalFields()
	{
		$baseKey = $this->getBaseKey();
		return array($baseKey => true);
	}

	function getBaseKey()
	{
		global $prefs;
		$indexKey = $prefs['unified_trackerfield_keys'];
		return 'tracker_field_' . $this->getConfiguration($indexKey);
	}
}


