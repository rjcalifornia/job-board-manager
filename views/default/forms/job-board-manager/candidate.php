<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 class="elgg-listing-summary-title-company">
<?php 
echo elgg_echo('job:board:apply');

?>
</h1>
</br>
<?php
//echo $vars['entity']->guid;

$container = $vars['entity']->guid;

$name_label = elgg_echo('job:board:candidate_name');
$name_input = elgg_view('input/text', array(
	'name' => 'candidate_name',
	'id' => 'candidate_name',
        'required' => true,
	'value' => $vars['candidate_name']
));

$email_label = elgg_echo('job:board:candidate_email');
$email_input = elgg_view('input/text', array(
	'name' => 'candidate_email',
	'id' => 'candidate_email',
        'required' => true,
	'value' => $vars['candidate_email']
));


$phone_label = elgg_echo('job:board:candidate_phone');
$phone_input = elgg_view('input/text', array(
	'name' => 'candidate_phone',
	'id' => 'candidate_phone',
        'required' => true,
	'value' => $vars['candidate_phone']
));


$resume_label = elgg_echo('job:board:candidate_resume');
$resume_input = elgg_view('input/file', array(
	'name' => 'candidate_resume',
	'label' => 'Select a file to upload',
        'required' => true,
	
));


$hidden_job = elgg_view('input/text', array(
	'name' => 'job_container',
	'id' => 'candidate_job_container',
        'hidden' => true,
	'value' => $container
));

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));
$apply_label = elgg_echo('job:board:apply_button');

echo <<<___HTML
<div style="background: #9f9f9f !important; margin: 0 5px 5px 0; padding: 8px 10px; border-radius: 3px; color: white; font-weight: 400; width:28%; font-size: 18px;" id="btn" class="btn btn-default">
        <span class="fa elgg-icon-send fa-send"></span> $apply_label            
</div>
   </br>
<div id="Create" style="display:none">
</br>
<div>
	<label for="job_title">$name_label</label>
	$name_input
</div>
</br>
<div>
	<label for="job_title">$email_label</label>
	$email_input
</div>
</br>
<div>
	<label for="job_title">$phone_label</label>
	$phone_input
</div>
</br>
<div>
	<label for="job_title">$resume_label</label>
	$resume_input
</div>
</br>

$hidden_job
___HTML;

$footer = <<<___HTML

$save_button
    </div>
</br>
___HTML;

elgg_set_form_footer($footer);

echo elgg_view('job-board-manager/application_form');
?>
