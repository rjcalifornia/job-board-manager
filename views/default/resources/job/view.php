<?php

$guid = (int) elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', 'job');

$entity = get_entity($guid);


elgg_push_collection_breadcrumbs('object', 'job');

$sidebar = elgg_view('job/sidebar', [
	'entity' => $entity,
]);

if (elgg_get_plugin_setting('styled_mode', 'job-board-manager') == 'yes'){
	$sidebar = elgg_view('job/styled_sidebar', $vars);
}

echo elgg_view_page($entity->getDisplayName(), [
	'content' => elgg_view_entity($entity, [
		'full_view' => true,
		'show_responses' => false,
	]),
	'filter_id' => 'job/view',
	'entity' => $entity,
	'sidebar' => $sidebar,
], 'default', [
	'entity' => $entity,
]);
