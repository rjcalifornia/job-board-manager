<?php

$guid = (int) elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', 'job');

$entity = get_entity($guid);

elgg_push_entity_breadcrumbs($entity);

echo elgg_view_page($entity->getDisplayName(), [
	'content' => elgg_view_entity($entity, [
		'full_view' => true,
		'show_responses' => false,
	]),
	'filter_id' => 'job/view',
	'entity' => $entity,
	'sidebar' => elgg_view('job/sidebar', [
		'entity' => $entity,
		'single' => true,
	]),
], 'default', [
	'entity' => $entity,
]);
