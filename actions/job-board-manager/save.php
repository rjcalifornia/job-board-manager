<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$title = get_input('title');
$description = get_input('description');
$totalOpenings = get_input('total_openings');
$jobType = get_input('job_type');
$jobLevel = get_input('job_level');
$yearsExperience = get_input('years_experience');
$salaryType = get_input('salary_type');
$fixedSalary = get_input('fixed_salary');
$salaryDuration = get_input('salary_duration');
$salaryCurrency = get_input('salary_currency');

$companyName = get_input('company_name');
$companyLocation = get_input('company_location');
$companyAddress = get_input('company_address');
$companyWebsite = get_input('company_website');
$expirationDate = get_input('expiration_date');
$status = get_input('status');
$tags = string_to_tag_array(get_input('tags'));








$access = get_input('access_id');
$comments = get_input('comments_on');
$guid = get_input('guid');

$container = (int)get_input('container_guid');


//$videoDetails = array();

if ($guid) {
	$entity = get_entity($guid);
        $entity->title = $title;
        $entity->description = $description;
        $entity->total_openings = $totalOpenings;
        $entity->job_type = $jobType;
        $entity->job_level = $jobLevel;
        $entity->years_experience = $yearsExperience;
        $entity->salary_type = $salaryType;
        $entity->fixed_salary = $fixedSalary;
        $entity->salary_duration = $salaryDuration;
        $entity->salary_currency = $salaryCurrency;
        $entity->company_name = $companyName;
        $entity->company_location = $companyLocation;
        $entity->company_address = $companyAddress;
        $entity->company_website = $companyWebsite;
        $entity->expiration_date = $expirationDate;

        $entity->access_id = $access;
        $entity->comments_on = $comments;
        
        

        
        $entity->status = $status;
        $jobGuid = $entity->save();
        if ($jobGuid) {
   system_message("Your job details were saved.");
   forward($entity->getURL());
} else {
   register_error("The job could not be saved.");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}
}
else{
    

$jobEntity = new ElggJobBoardManager();
$jobEntity->title = $title;
$jobEntity->description = $description;
$jobEntity->total_openings = $totalOpenings;
$jobEntity->job_type = $jobType;
$jobEntity->job_level = $jobLevel;
$jobEntity->years_experience = $yearsExperience;
$jobEntity->salary_type = $salaryType;
$jobEntity->fixed_salary = $fixedSalary;
$jobEntity->salary_duration = $salaryDuration;
$jobEntity->salary_currency = $salaryCurrency;
$jobEntity->company_name = $companyName;
$jobEntity->company_location = $companyLocation;
$jobEntity->company_address = $companyAddress;
$jobEntity->company_website = $companyWebsite;
$jobEntity->expiration_date = $expirationDate;

$jobEntity->access_id = $access;
$jobEntity->comments_on = $comments;
$jobEntity->subtype = 'job-board-manager';
$jobEntity->container_guid = $container;

$jobEntity->owner_guid = elgg_get_logged_in_user_guid();
$jobEntity->status = $status;

$jobEntityGuid = $jobEntity->save();

// if the my_blog was saved, we want to display the new post
// otherwise, we want to register an error and forward back to the form
if ($jobEntityGuid) {
   system_message("Your video was shared.");
   forward($jobEntity->getURL());
} else {
   register_error("The video could not be saved.");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}
}


