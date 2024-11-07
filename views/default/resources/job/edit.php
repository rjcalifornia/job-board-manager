<?php

use Elgg\Exceptions\Http\EntityNotFoundException;

$guid = (int) elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', 'job', true);

/* @var $blog \ElggBlog */
$job = get_entity($guid);

$vars['entity'] = $job;

elgg_push_entity_breadcrumbs($job);

$revision_id = (int) elgg_extract('revision', $vars);
$revision = null;

$title = elgg_echo('edit:object:job');

if (!empty($revision_id)) {
	$revision = elgg_get_annotation_from_id($revision_id);
	$vars['revision'] = $revision;
	$title .= ' ' . elgg_echo('job:edit_revision_notice');

	if (!$revision instanceof \ElggAnnotation || $revision->entity_guid !== $guid) {
		throw new EntityNotFoundException(elgg_echo('job:error:revision_not_found'));
	}
}

$form_vars = [
	'sticky_enabled' => true,
];

$body_vars = [
	'entity' => $job,
	'revision' => $revision,
];

echo elgg_view_page($title, [
	'content' => elgg_view_form('job/save', $form_vars, $body_vars),
	'sidebar' => elgg_view('job/sidebar', $vars),
	'filter_id' => 'job/edit',
]);
