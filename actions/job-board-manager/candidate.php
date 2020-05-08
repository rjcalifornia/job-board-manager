<?php
$ia = elgg_set_ignore_access(true);
elgg_set_ignore_access(true);

$candidateName = get_input('candidate_name');
$candidateEmail = get_input('candidate_email');
$candidatePhone = get_input('candidate_phone');
$candidateJobContainer = get_input('job_container');
$candidateResume = elgg_get_uploaded_files('candidate_resume');

$candidateEntity = new ElggJobCandidates;
$candidateEntity->owner_guid = 1;
$candidateEntity->title = $candidateName;
$candidateEntity->candidate_email = $candidateEmail;
$candidateEntity->candidate_phone = $candidatePhone;
$candidateEntity->subtype = 'job-candidates';
$candidateEntity->container_guid = $candidateJobContainer;

if ($candidateResume) {
$uploaded_file = array_shift($candidateResume);
if (!$uploaded_file->isValid()) {
        $error = elgg_get_friendly_upload_error($uploaded_file->getError());
        register_error($error);
        forward(REFERER);
}
}


$candidateEntity->save();

if($uploaded_file)  
{
$file = new ElggResumes();
$file->title = $file->getFilename();

$file->owner_guid = 1;
$file->container_guid = $candidateEntity->getGUID();
$file->access_id = 2;

if ($file->acceptUploadedFile($uploaded_file)) {
        //$guid = $file->save(); 
        $file->save();
        
          
}
        }
system_message("Your application was successfully submitted.");
forward(REFERER); 