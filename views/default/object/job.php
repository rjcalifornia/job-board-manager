<?php

/**
 * View for blog objects
 *
 * @uses $vars['entity'] ElggBlog entity to show
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \ElggJob) {
	return;
}

if (!isset($vars['imprint'])) {
	$vars['imprint'] = [];
}

if ($entity->status && $entity->status !== 'published') {
	$vars['imprint'][] = [
		'icon_name' => 'warning',
		'content' => elgg_echo("status:{$entity->status}"),
		'class' => 'elgg-listing-blog-status',
	];

	// Show the access the blog will have when published
	$vars['access'] = $entity->future_access;
}

if (elgg_extract('full_view', $vars)) {
	$twig = jobs_twig();

	$data['labels'] = [
		'overview' => elgg_echo('job:overview'),
		'qualifications' => elgg_echo('job:qualifications'),
	];
	$data['overview'] = $entity->overview;
	$data['qualifications'] = $entity->qualifications;

	echo $twig->render(
		'pages/view.html.twig',
		[
			'data' => $data,
		]
	);
} else {
	// brief view
	$params = [
		'content' => $entity->getSummary(),
		'icon' => true,
	];
	$params = $params + $vars;
	echo elgg_view('object/elements/summary', $params);
}
