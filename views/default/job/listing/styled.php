<?php
/**
 * Display jobs listing
 *
 * Note: this view has a corresponding view in the rss view type, changes should be reflected
 *
 * @uses $vars['options'] Additional listing options
 */
$twig = jobs_twig();

$defaults = [
	'type' => 'object',
	'subtype' => 'job',
	'full_view' => false,
	'no_results' => elgg_echo('jobs:none'),
	'distinct' => false,
];

$options = (array) elgg_extract('options', $vars, []);
$options = array_merge($defaults, $options);

$entities= elgg_get_entities($defaults);

foreach ($entities as $entity) {
	$entity->url = $entity->getUrl();
}
$data = [
	'site_url' => elgg_get_site_url(),
];

echo $twig->render(
	'job/pages/all.html.twig',
	[
		'entities' => $entities,
		'data' => $data,
 
	]
);
