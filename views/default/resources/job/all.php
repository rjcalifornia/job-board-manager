<?php
/**
 * Elgg jobs plugin everyone page
 */

elgg_push_collection_breadcrumbs('object', 'job');

elgg_register_title_button('add', 'object', 'job');

$view =  elgg_view('job/listing/all', $vars);

if (elgg_get_plugin_setting('styled_mode', 'job-board-manager') == 'yes'){
	$view = elgg_view('job/listing/styled', $vars);
}
echo elgg_view_page(elgg_echo('collection:object:job:all'), [
	'filter_id' => 'filter',
	'filter_value' => 'all',
	'content' => $view,
	'sidebar' => elgg_view('job/sidebar', $vars),
]);
