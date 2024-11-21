<?php

use \JobUtils as JobUtils;




elgg_call(ELGG_IGNORE_ACCESS, function()  {


$jobUtils = new JobUtils;
$guid = get_input('__elgg_guid');
$firstName = get_input('first_name');
$lastName = get_input('last_name');
$email = get_input('email');
$phone = get_input('phone');
$linkedin = get_input('linkedin');
$coverLetter = get_input('cover_letter');

$resume = elgg_get_uploaded_file('resume');
if (!$resume) {
	return elgg_error_response(elgg_echo('job:upload:failed'));
}


$supported_mimes = [
	'application/pdf',
];

$mime_type = elgg()->mimetype->getMimeType($resume->getPathname());
if (!in_array($mime_type, $supported_mimes)) {
	return elgg_error_response(elgg_echo('job:upload:not_supported'));
}


$entity = get_entity($guid);

$application = new \ElggJobApplication;

$application->first_name = $firstName;
$application->last_name = $lastName;
$application->email = $email;
$application->phone = $phone;
$application->cover_letter = $coverLetter;
$application->linkedin = $linkedin;
$application->container_guid = $entity->guid;
$application->access_id = 2;
$application->owner_guid = $entity->guid;
$application->application_identifier = substr($jobUtils->generateIdentifier(), 0, 16);


if (!$application->save()) {
	return elgg_error_response(elgg_echo('job:application:failed'));
}

$file = new ElggResume();
$file->container_guid = $application->getGUID();
$file->access_id = 2;
$file->owner_guid = 1;
if ($file->acceptUploadedFile($resume)) {
	$file->title =  $jobUtils->generateIdentifier() . '.pdf';
	$file->save();
}

return elgg_ok_response('', elgg_echo('job:application:success'), $entity->getURL());
});