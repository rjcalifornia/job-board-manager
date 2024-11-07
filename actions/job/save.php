<?php
/**
 * Elgg job save action
 */
use JobUtils;

$jobUtils = new JobUtils;

$title = elgg_get_title_input();
$overview = get_input('overview');
$qualifications = get_input('qualifications');
$responsabilities = get_input('responsabilities');
$salary = get_input('salary');
$salary_type = get_input('salary_type');
$jobType = get_input('job_type');
$location = get_input('location');
$experience = get_input('experience');
$openings = get_input('openings');
$deadline = get_input('deadline');
$access_id = (int) get_input('access_id');
$status = get_input('status');
$tags = get_input('tags');


$guid = (int) get_input('guid');
$container_guid = (int) get_input('container_guid', elgg_get_logged_in_user_guid());
$tagarray = elgg_string_to_array($tags);
 
if (empty($title)) {
	return elgg_error_response(elgg_echo('job:save:failed'));
}

 
$new = true;
if (empty($guid)) {
	$job = new \ElggJob;
	$job->container_guid = $container_guid;
} else {
	$job = get_entity($guid);
	if (!$job instanceof \ElggJob || !$job->canEdit()) {
		return elgg_error_response(elgg_echo('job:save:failed'));
	}
	
	$new = false;
}

$job->title = $title;
$job->overview = $overview;
$job->qualifications = $qualifications;
$job->responsabilities = $responsabilities;
$job->job_type = $jobType;
$job->experience = $experience;
$job->salary = $salary;
$job->location = $location;
$job->salary_type = $salary_type;
$job->openings = $openings;
$job->deadline = $deadline;
$job->tags = $tagarray;
$job->status = $status;
$job->access_id = $access_id;
$job->correlative = $jobUtils->generateIdentifier();
 

if (!$job->save()) {
	return elgg_error_response(elgg_echo('job:save:failed'));
}

//add to river only if new
// if ($new) {
// 	elgg_create_river_item([
// 		'view' => 'river/object/job/create',
// 		'action_type' => 'create',
// 		'object_guid' => $job->guid,
// 	]);
// }

return elgg_ok_response('', elgg_echo('job:save:success'), $job->getURL());
