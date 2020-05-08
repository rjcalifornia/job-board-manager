<?php
/**
 * Edit job form
 *
 * @package Job Board Manager
 */

$job = get_entity($vars['guid']);
$vars['entity'] = $job;


$action_buttons = '';
$delete_link = '';
$preview_button = '';

if ($vars['guid']) {
	// add a delete button if editing
	$delete_url = "action/job/delete?guid={$vars['guid']}";
	$delete_link = elgg_view('output/url', array(
		'href' => $delete_url,
		'text' => elgg_echo('delete'),
		'class' => 'elgg-button elgg-button-delete float-alt',
		'confirm' => true,
	));
}


$jobSelectTypes =[
    elgg_echo('job:board:full') => elgg_echo('job:board:full'),
    elgg_echo('job:board:freelance') => elgg_echo('job:board:freelance'),
    elgg_echo('job:board:intership') => elgg_echo('job:board:intership'),
    elgg_echo('job:board:part_time') => elgg_echo('job:board:part_time'),
    elgg_echo('job:board:temporary') => elgg_echo('job:board:temporary'),
    
];

$jobSelectLevel =[
    elgg_echo('job:board:all') => elgg_echo('job:board:all'),
    elgg_echo('job:board:entry') => elgg_echo('job:board:entry'),
    elgg_echo('job:board:mid') => elgg_echo('job:board:mid'),
    elgg_echo('job:board:top') => elgg_echo('job:board:top'),
    
    
];

$jobSelectSalaryDuration =[
    elgg_echo('job:board:hour') => elgg_echo('job:board:hour'),
    elgg_echo('job:board:day') => elgg_echo('job:board:day'),
    elgg_echo('job:board:week') => elgg_echo('job:board:week'),
    elgg_echo('job:board:month') => elgg_echo('job:board:month'),
    elgg_echo('job:board:year') => elgg_echo('job:board:year'),
    
    
];



$jobSelectSalaryType =[
    elgg_echo('job:board:negotiable') => elgg_echo('job:board:negotiable'),
    elgg_echo('job:board:fixed') => elgg_echo('job:board:fixed'),
];

$draft_warning = $vars['draft_warning'];
if ($draft_warning) {
	$draft_warning = '<span class="mbm elgg-text-help">' . $draft_warning . '</span>';
}


if (!$vars['guid'] || ($job && $job->status != 'published')) {
	$preview_button = elgg_view('input/submit', array(
		'value' => elgg_echo('preview'),
		'name' => 'preview',
		'class' => 'elgg-button-submit mls',
	));
}

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));
$action_buttons = $save_button . $preview_button . $delete_link;

$title_label = elgg_echo('job:board:title');
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'job_title',
        'required' => true,
	'value' => $vars['title']
));



$description_label = elgg_echo('job:board:description');
$description_input = elgg_view('input/longtext', array(
	'name' => 'description',
	'id' => 'job_description',
        'required' => true,
	'value' => $vars['description']
));


$openings_label = elgg_echo('job:board:total_openings');
$openings_input = elgg_view('input/text', array(
	'name' => 'total_openings',
	'id' => 'job_total_openings',
        'required' => true,
	'value' => $vars['total_openings']
));


$job_type_label = elgg_echo('job:board:type');
$job_type_input = elgg_view('input/select', array(
	'name' => 'job_type',
	'id' => 'job_job_type',
        'required' => true,
	'options_values' => $jobSelectTypes,
'value' => $vars['job_type'],
));

$job_level_label = elgg_echo('job:board:level');
$job_level_input = elgg_view('input/select', array(
	'name' => 'job_level',
	'id' => 'job_job_level',
        'required' => true,
	'options_values' => $jobSelectLevel,
'value' => $vars['job_level'],
));

$years_experience_label = elgg_echo('job:board:years_experience');
$years_experience_input = elgg_view('input/text', array(
	'name' => 'years_experience',
	'id' => 'job_years_experience',
        'required' => true,
	'value' => $vars['years_experience']
));

$salary_type_label = elgg_echo('job:board:salary_type');
$salary_type_input = elgg_view('input/select', array(
	'name' => 'salary_type',
	'id' => 'job_salary_type',
        'required' => true, 
	'options_values' => $jobSelectSalaryType,
'value' => $vars['salary_type'],
));


$fixed_salary_label = elgg_echo('job:board:fixed_salary');
$fixed_salary_input = elgg_view('input/text', array(
	'name' => 'fixed_salary',
	'id' => 'job_fixed_salary',
	'value' => $vars['fixed_salary']
));

$salary_duration_label = elgg_echo('job:board:salary_duration');
$salary_duration_input = elgg_view('input/select', array(
	'name' => 'salary_duration',
	'id' => 'job_salary_duration',
	'options_values' => $jobSelectSalaryDuration,
'value' => $vars['salary_duration'],
));

$salary_currency_label = elgg_echo('job:board:salary_currency');
$salary_currency_input = elgg_view('input/text', array(
	'name' => 'salary_currency',
	'id' => 'job_salary_currency',
	'value' => $vars['salary_currency']
));


$contact_email_label = elgg_echo('job:board:contact_email');
$contact_email_input = elgg_view('input/text', array(
	'name' => 'contact_email',
	'id' => 'job_contact_email',
	'value' => $vars['contact_email']
));

$company_name_label = elgg_echo('job:board:company_name');
$company_name_input = elgg_view('input/text', array(
	'name' => 'company_name',
        'required' => true,
	'id' => 'job_company_name',
	'value' => $vars['company_name']
));


$company_location_label = elgg_echo('job:board:company_location');
$company_location_input = elgg_view('input/text', array(
	'name' => 'company_location',
        'required' => true,
	'id' => 'job_company_location',
	'value' => $vars['company_location']
));


$company_address_label = elgg_echo('job:board:company_address');
$company_address_input = elgg_view('input/text', array(
	'name' => 'company_address',
	'id' => 'job_company_address',
        'required' => true,
	'value' => $vars['company_address']
));


$company_website_label = elgg_echo('job:board:company_website');
$company_website_input = elgg_view('input/text', array(
	'name' => 'company_website',
	'id' => 'job_company_website',
        'required' => true,
	'value' => $vars['company_website']
));

$expiration_date_label = elgg_echo('job:board:expiration_date');
$expiration_date_input = elgg_view('input/date', array(
	'name' => 'expiration_date',
	'id' => 'job_expiration_date',
        'required' => true,
	'value' => $vars['expiration_date']
));



/*
$excerpt_label = elgg_echo('job:board:excerpt');
$excerpt_input = elgg_view('input/text', array(
	'name' => 'excerpt',
	'id' => 'job_excerpt',
	'value' => $vars['description']
));
 */



$save_status = elgg_echo('job:board:save_status');
if ($vars['guid']) {
	$entity = get_entity($vars['guid']);
	$saved = date('F j, Y @ H:i', $entity->time_updated);
} else {
	$saved = elgg_echo('never');
}

$status_label = elgg_echo('status');
$status_input = elgg_view('input/select', array(
	'name' => 'status',
	'id' => 'job_status',
	'value' => $vars['status'],
	'options_values' => array(
		'draft' => elgg_echo('status:draft'),
		'published' => elgg_echo('status:published')
	)
));

$comments_label = elgg_echo('comments');
$comments_input = elgg_view('input/select', array(
	'name' => 'comments_on',
	'id' => 'job_comments_on',
	'value' => $vars['comments_on'],
	'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off'))
));

$tags_label = elgg_echo('tags');
$tags_input = elgg_view('input/tags', array(
	'name' => 'tags',
	'id' => 'job_tags',
	'value' => $vars['tags']
));

$access_label = elgg_echo('access');
$access_input = elgg_view('input/access', array(
	'name' => 'access_id',
	'id' => 'job_access_id',
	'value' => $vars['access_id'],
	'entity' => $vars['entity'],
	'entity_type' => 'object',
	'entity_subtype' => 'job',
));

$categories_input = elgg_view('input/categories', $vars);

// hidden inputs
$container_guid_input = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => elgg_get_page_owner_guid()));
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));


echo <<<___HTML

$draft_warning

<div>
	<label for="job_title">$title_label</label>
	$title_input
</div>

 

<div>
	<label for="job_description">$description_label</label>
	$description_input
</div>

<div>
	<label for="job_description">$openings_label</label>
	$openings_input
</div>


<div>
	<label for="job_description">$job_type_label</label>
	$job_type_input
</div>

<div>
	<label for="job_description">$job_level_label</label>
	$job_level_input
</div>

<div>
	<label for="job_description">$years_experience_label</label>
	$years_experience_input
</div>


<div>
	<label for="job_description">$salary_type_label</label>
	$salary_type_input
</div>

<div>
	<label for="job_description">$fixed_salary_label</label>
	$fixed_salary_input
</div>

<div>
	<label for="job_description">$salary_duration_label</label>
	$salary_duration_input
</div>


<div>
	<label for="job_description">$salary_currency_label</label>
	$salary_currency_input
</div>

<div>
	<label for="job_description">$company_name_label</label>
	$company_name_input
</div>

<div>
	<label for="job_description">$company_location_label</label>
	$company_location_input
</div>

<div>
	<label for="job_description">$company_address_label</label>
	$company_address_input
</div>


<div>
	<label for="job_description">$company_website_label</label>
	$company_website_input
</div>

<div>
	<label for="job_description">$expiration_date_label</label>
	$expiration_date_input
</div>


<div>
	<label for="job_tags">$tags_label</label>
	$tags_input
</div>

$categories_input

 

<div>
	<label for="job_access_id">$access_label</label>
	$access_input
</div>

<div>
	<label for="job_status">$status_label</label>
	$status_input
</div>

$guid_input
$container_guid_input

___HTML;

$footer = <<<___HTML
<div class="elgg-subtext mbm">
	$save_status <span class="job-save-status-time">$saved</span>
</div>
$action_buttons
___HTML;

elgg_set_form_footer($footer);

?>
