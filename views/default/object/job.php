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

	$labels = [
		'overview' => elgg_echo('job:overview'),
		'qualifications' => elgg_echo('job:qualifications'),
		'type' => elgg_echo('job:type'),
		'openings' => elgg_echo('job:openings'),
	];
	 
	 
	$data = [
		'overview' => $entity->overview,
		'qualifications' => $entity->qualifications,
		'job_type' => $entity->job_type,
		'openings' => $entity->openings,
	];

	echo $twig->render(
		'pages/view.html.twig',
		[
			'data' => $data,
			'labels' => $labels,
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
