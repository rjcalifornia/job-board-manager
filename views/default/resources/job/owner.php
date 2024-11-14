<?php

$lower = elgg_extract('lower', $vars);
$upper = elgg_extract('upper', $vars);

$user = elgg_get_page_owner_entity();

elgg_register_title_button('add', 'object', 'job');

elgg_push_collection_breadcrumbs('object', 'job', $user);

if ($user->guid === elgg_get_logged_in_user_guid()) {
	$title = elgg_echo('collection:object:job');
} else {
	$title = elgg_echo('collection:object:job:owner', [$user->getDisplayName()]);
}

if ($lower) {
	$title .= ': ' . elgg_echo('date:month:' . date('m', $lower), [date('Y', $lower)]);
}

echo elgg_view_page($title, [
	'content' => elgg_view('job/listing/owner', [
		'entity' => $user,
		'created_after' => $lower,
		'created_before' => $upper,
	]),
	'sidebar' => elgg_view('job/sidebar', [
		'page' => 'owner',
		'entity' => $user,
	]),
	'filter_value' => $user->guid === elgg_get_logged_in_user_guid() ? 'mine' : 'none',
]);
