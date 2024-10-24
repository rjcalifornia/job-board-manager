<?php
/**
 * Edit job form
 */

elgg_import_esm('forms/job/save');

$job = elgg_extract('entity', $vars);

echo elgg_view('entity/edit/header', [
	'entity' => $job,
	'entity_type' => 'object',
	'entity_subtype' => 'job',
]);

$categories_vars = $vars;
$categories_vars['#type'] = 'categories';

$fields = [
	[
		'#label' => elgg_echo('title'),
		'#type' => 'text',
		'name' => 'title',
		'required' => true,
		'id' => 'job_title',
		'value' => elgg_extract('title', $vars),
	],
	[
		'#label' => elgg_echo('job:excerpt'),
		'#type' => 'text',
		'name' => 'excerpt',
		'id' => 'job_excerpt',
		'value' => elgg_extract('excerpt', $vars),
	],
	[
		'#label' => elgg_echo('job:body'),
		'#type' => 'longtext',
		'name' => 'description',
		'required' => true,
		'id' => 'job_description',
		'value' => elgg_extract('description', $vars),
	],
	[
		'#label' => elgg_echo('tags'),
		'#type' => 'tags',
		'name' => 'tags',
		'id' => 'job_tags',
		'value' => elgg_extract('tags', $vars),
	],
	$categories_vars,
	[
		'#label' => elgg_echo('comments'),
		'#type' => 'checkbox',
		'name' => 'comments_on',
		'id' => 'job_comments_on',
		'default' => 'Off',
		'value' => 'On',
		'switch' => true,
		'checked' => elgg_extract('comments_on', $vars) === 'On',
	],
	[
		'#label' => elgg_echo('access'),
		'#type' => 'access',
		'name' => 'access_id',
		'id' => 'job_access_id',
		'value' => elgg_extract('access_id', $vars),
		'entity' => elgg_extract('entity', $vars),
		'entity_type' => 'object',
		'entity_subtype' => 'job',
	],
	[
		'#label' => elgg_echo('status'),
		'#type' => 'select',
		'name' => 'status',
		'id' => 'job_status',
		'value' => elgg_extract('status', $vars),
		'options_values' => [
			'draft' => elgg_echo('status:draft'),
			'published' => elgg_echo('status:published'),
		],
	],
	[
		'#type' => 'container_guid',
		'entity_type' => 'object',
		'entity_subtype' => 'job',
	],
	[
		'#type' => 'hidden',
		'name' => 'guid',
		'value' => elgg_extract('guid', $vars),
	],
];

foreach ($fields as $field) {
	echo elgg_view_field($field);
}

$saved = $job instanceof \ElggJob ? elgg_view('output/friendlytime', ['time' => $job->time_updated]) : elgg_echo('never');
$saved = elgg_format_element('span', ['class' => 'job-save-status-time'], $saved);

$footer = elgg_format_element('div', ['class' => ['elgg-subtext', 'mbm']], elgg_echo('job:save_status') . ' ' . $saved);

$footer .= elgg_view('input/submit', [
	'name' => 'save',
	'value' => 1,
	'text' => elgg_echo('save'),
]);

// published job do not get the preview button
if (!$job instanceof \ElggJob || $job->status != 'published') {
	$footer .= elgg_view('input/button', [
		'name' => 'preview',
		'value' => 1,
		'text' => elgg_echo('preview'),
		'class' => 'elgg-button-action mls',
	]);
}

elgg_set_form_footer($footer);
