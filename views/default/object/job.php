<?php

/**
 * View for blog objects
 *
 * @uses $vars['entity'] ElggBlog entity to show
 */

$entity = elgg_extract('entity', $vars);
$showApplications = false;
if (!$entity instanceof \ElggJob) {
	return;
}

if (!isset($vars['imprint'])) {
	$vars['imprint'] = [];
}


$owner = $entity->getOwnerEntity();
$loggedUser = elgg_get_logged_in_user_entity();

if ($owner->guid == $loggedUser?->guid) {
	$showApplications = true;
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

switch ($entity->status) {
	case 'published':
		$jobStatus =  elgg_echo('job:open');
		break;
	default:
		$jobStatus = elgg_echo('job:closed');
}


if (elgg_extract('full_view', $vars)) {
	$twig = jobs_twig();
	$ts = elgg()->csrf->getCurrentTime()->getTimestamp();
	$token = elgg()->csrf->generateActionToken($ts);

	$applications_defaults = [
		'type' => 'object',
		'container_guid' => $entity->guid,
		'subtype' => 'job_application',
		'full_view' => false,
		'no_results' => elgg_echo('jobs:applications:none'),
		'distinct' => false,
	];

	$options = (array) elgg_extract('options', $vars, []);
	$options = array_merge($applications_defaults, $options);

	$applications = elgg_get_entities($options);

	foreach ($applications as $application) {
		$resume = elgg_get_entities([
			'type' => 'object',
			'subtype' => 'resume',
			'full_view' => false,
			'preload_containers' => true,
			'distinct' => false,
			
			
		]);
		//dd($resume);
		if ($resume) {
			$entity = get_entity($resume[0]->guid);
			//dd($entity);
			$url = elgg_get_download_url($entity);
			
			$application->url = $url;
		}
	}



	$labels = [
		'overview' => elgg_echo('job:overview'),
		'qualifications' => elgg_echo('job:qualifications'),
		'type' => elgg_echo('job:type'),
		'openings' => elgg_echo('job:openings'),
		'salary' => elgg_echo('job:salary'),
		'experience' => elgg_echo('job:experience'),
		'published' => elgg_echo('job:published'),
		'deadline' => elgg_echo('job:label_deadline'),
	];

	$data = [
		'title' => $entity->title,
		'correlative' => $entity->correlative,
		'overview' => $entity->overview,
		'qualifications' => $entity->qualifications,
		'job_type' => $entity->job_type,
		'openings' => $entity->openings,
		'location' => $entity->location,
		'salary' => $entity->salary,
		'experience' => $entity->experience,
		'deadline' => $entity->deadline,
		'status' => $jobStatus,
		'published' => date(("F j, Y"), $entity->time_created),
		'categories' => $entity->tags,
		'site_url' =>  elgg_get_site_url(),
		'elgg_timestamp' => $ts,
		'elgg_token' => $token,
		'elgg_guid' => $entity->guid,
		'applications' => $applications,
		'show_applications' => $showApplications

	];




	echo $twig->render(
		'job/pages/view.html.twig',
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
