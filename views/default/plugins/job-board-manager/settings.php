<?php
/**
 * Groups plugin settings
 */

/* @var ElggPlugin $plugin */
$plugin = elgg_extract('entity', $vars);

$fields = [
	[
		'#type' => 'checkbox',
		'#label' => elgg_echo('job:usestyledmode'),
		'name' => 'params[styled_mode]',
		'default' => 'no',
		'switch' => true,
		'value' => 'yes',
		'checked' => ($plugin->styled_mode === 'yes'),
	],
];


foreach ($fields as $field) {
	echo elgg_view_field($field);
}