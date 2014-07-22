<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: function.rating_result_avg.php 50065 2014-02-24 16:05:59Z xavidp $

function smarty_function_rating_result_avg( $params, $smarty )
{
	global $prefs, $ratinglib;
	require_once 'lib/rating/ratinglib.php';
	$votings = $ratinglib->votings($params['id'], $params['type']);
	$options = $ratinglib->get_options($params['type'], $params['id']);

	$vote_sum = 0;
	$vote_count_total = 0;
	// if there are no votes yet, don't show zero to avoid confusion with users voting 0 for the article; show dash instead ('-')
	$vote_avg = '-';

	if (count($votings)) {
		foreach ($votings as $vote => $voting) {
			$vote_sum += $vote * $voting['votes'];
			$vote_count_total += $voting['votes'];
		}
		$vote_avg = number_format($vote_sum / $vote_count_total, 1);
		// if the average has zero as decimal, do not show the decimal.
		if (floor($vote_avg) == $vote_avg) {
			$vote_avg = $vote_sum / $vote_count_total;
		}
	}
	//Why $vote_collect yields a different value than $vote_avg?
	//$vote_collect = $ratinglib->collect($params['type'], $params['id'], 'avg', array_filter($votings));

	return "<span class='score'>" . $vote_avg . " / " . count($options) . "</span>";
}
