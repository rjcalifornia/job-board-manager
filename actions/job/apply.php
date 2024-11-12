<?php

use JobUtils;

$jobUtils = new JobUtils;
elgg_call(ELGG_IGNORE_ACCESS, function() use ($jobUtils) {
$guid = get_input('__elgg_guid');
$firstName = get_input('first_name');
$lastName = get_input('last_name');
$email = get_input('email');
$phone = get_input('phone');
$coverLetter = get_input('cover_letter');


$entity = get_entity($guid);

$application = new \ElggJobApplication;

$application->first_name = $firstName;
$application->last_name = $lastName;
$application->email = $email;
$application->phone = $phone;
$application->cover_letter = $coverLetter;
$application->container_guid = $guid;
$application->access_id = 2;
//$application->resume = $file;
$application->application_identifier = $jobUtils->generateIdentifier();

if (!$application->save()) {
	return elgg_error_response(elgg_echo('job:application:failed'));
}

return elgg_ok_response('', elgg_echo('job:save:success'), $entity->getURL());
});