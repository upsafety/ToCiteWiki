<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.rating_result.php 50006 2014-02-21 18:21:19Z xavidp $

function smarty_function_rating_result( $params, $smarty )
{
	global $prefs, $ratinglib;
	require_once 'lib/rating/ratinglib.php';
	$votings = $ratinglib->votings($params['id'], $params['type']);
	$smiles = $ratinglib->get_options_smiles($params['type'], $params['id'], true);
	$tableBody = "";

	if ($prefs['rating_results_detailed'] == 'y') {

	foreach ($votings as $vote => $voting) {
		if ($prefs['rating_results_detailed_percent'] == 'y') {
			$extra_info = '/' . $voting['percent'] . '%)';
		} else {
			$extra_info = ')';
		}
		$tableBody .= '<td style="width:' . $voting['percent'] . '%; text-align: center;">
			<div class="ui-widget-content">' .
				($prefs['rating_smileys'] == 'y' ? '<img src="' . $smiles[$vote]['img'] . '"/> ' : '<b>' . $vote . '</b> ') .
				'(' . $voting['votes'] . $extra_info .
				($prefs['rating_smileys'] == 'y' ? '<div style="background-color: ' . $smiles[$vote]['color'] . ';">&nbsp;</div>' : '').
			'</div>
		</td>';
		}
	} else {
		$tableBody = '';
	}

	return "<table class='ratingDeliberationResultTable' style='width:100%;'><tr>" . $tableBody . "</tr></table>";
}
