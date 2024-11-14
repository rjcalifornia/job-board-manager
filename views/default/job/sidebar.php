<?php
/**
 * Jobs sidebar
 */
$page = elgg_extract('page', $vars);

$entity = elgg_extract('entity', $vars, elgg_get_page_owner_entity());


echo elgg_view('page/elements/tagcloud_block', [
	'subtypes' => 'job',
	'container_guid' => $entity ? $entity->guid : null,
]);
