<?php
/**
 * Elgg jobs plugin everyone page
 */

elgg_push_collection_breadcrumbs('object', 'job');

elgg_register_title_button('add', 'object', 'job');

echo elgg_view_page(elgg_echo('collection:object:job:all'), [
	'filter_id' => 'filter',
	'filter_value' => 'all',
	'content' => elgg_view('job/listing/all', $vars),
	'sidebar' => elgg_view('job/sidebar', $vars),
]);
