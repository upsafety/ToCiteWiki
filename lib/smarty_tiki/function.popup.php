<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.popup.php 49131 2013-12-17 16:07:28Z sept_7 $

/**
 * Smarty plugin for Tiki using jQuery ClueTip instead of OverLib
 */


/**
 * Smarty {popup} function plugin
 *
 * Type:     function<br>
 * Name:     popup<br>
 * Purpose:  make text pop up in windows via ClueTip
 * @link     not very relevant anymore http://smarty.php.net/manual/en/language.function.popup.php {popup}
 *           (Smarty online manual)
 * @author   Jonny Bradley, replacing Smarty original (by Monte Ohrt <monte at ohrt dot com>)
 * @param    array
 * @param    Smarty
 * @return   string now formatted to use cluetips natively
 *
 * params still relevant:
 *
 *     text        Required: the text/html to display in the popup window
 *     trigger     'onMouseOver' or 'onClick' (onMouseOver default)
 *     sticky      false/true
 *     width       in pixels?
 *     fullhtml
 */
function smarty_function_popup($params, $smarty)
{
	$options = array();
	$body = '';
	$title = '';

	foreach ($params as $key => $value) {
		switch ($key) {
			case 'text':
				$body = $value;
				break;
			case 'trigger':
				switch ($value) {
					case 'onclick':
					case 'onClick':
						$options['activation'] = 'click';
						break;
					default:
						break;
				}
				break;
			case 'caption':
				$title = $value;
				break;

			case 'width':
			case 'height':
				$options[$key] = $value;
				break;
			case 'sticky':
				$options[$key] = !empty($value);
				$options['mouseOutClose'] = false;
				break;
			case 'fullhtml':
				$options['escapeTitle'] = true;
				$options['cluetipClass'] = 'fullhtml';
				break;
			case 'background':
				$options['showTitle'] = false;
				$options['cluetipClass'] = 'fullhtml';
				if (!empty($params['width'])) {
					$body = '<div style="background-image:url(' . $value . ');width:' . $params['width'] . 'px;height:100%;">' . $body . '</div>';
					unset($params['width']);
					unset($options['width']);
				} else {
					$body = '<div style="background-image:url(' . $value . ');width:100%;height:100%;">' . $body . '</div>';
				}
				break;

			case 'left':
			case 'right':
			case 'center':
			case 'hauto':
			case 'vauto':
			case 'mouseoff':
				break;

			default:
				trigger_error("[popup] unknown parameter $key", E_USER_WARNING);
		}
	}

	if (empty($title) && empty($body)) {
		trigger_error("cluetips: attribute 'text' or 'caption' required");
		return false;
	}

	$body = preg_replace(array('/\\\\r\n/','/\\\\n/','/\\\\r/', '/\\t/'), '', $body);
	$body = str_replace('\&#039;', '&#039;', $body);	// unescape previous js escapes
	$body = str_replace('\&quot;', '&quot;', $body);
	$body = str_replace('&lt;\/', '&lt;/', $body);
	$retval = '';
	if (isset($options['activation']) && $options['activation'] !== 'click') {
		$retval = ' class="tips"';		// adds default ct options including 'hover' activation
	}
	if ($title) {
		$retval .= ' title="' . $title . '"';
	} else {
		$options['showTitle'] = false;
	}
	if ($body) {
		$retval .= ' data-cluetip-body=\'' . $body . '\'';
		$options['attribute'] = 'data-cluetip-body';
	}
	$retval .= ' data-cluetip-options=\'' . json_encode($options) . '\'';

	return $retval;
}
