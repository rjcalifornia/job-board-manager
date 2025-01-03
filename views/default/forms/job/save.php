<?php


$data['hidden_guid_input'] = '';
$guid = elgg_extract('guid', $vars, null);



$twig = jobs_twig();

if ($guid) {
    $hiddenGuid = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
    $data['hidden_guid_input'] = new \Twig\Markup($hiddenGuid, 'UTF-8');
}

elgg_import_esm("job/select2");
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);

$options =[
    elgg_echo('job:fulltime') =>    elgg_echo('job:fulltime'),
    elgg_echo('job:parttime') =>  elgg_echo('job:parttime'),
    elgg_echo('job:freelance') =>  elgg_echo('job:freelance'),
    elgg_echo('job:intership') =>  elgg_echo('job:intership'),
    elgg_echo('job:temporary') =>  elgg_echo('job:temporary'),
];

$experience =[
    '1' =>    '1',
    '2' =>    '2',
    '3' =>    '3',
    '4' =>    '4',
    '5' =>    '5',
    '6' =>    '6',
    '7' =>    '7',
    '8' =>    '8',
    '9' =>    '9',
    '10' =>    '10',
    '11' =>    '11',
    '12' =>    '12',
    '13' =>    '13',
    '14' =>    '14',
    '15' =>    '15',
    '16' =>    '16',
    '17' =>    '17',
    '18' =>    '18',
    '19' =>    '19',
    '20' =>    '20',
];
 

$salaryType =[
    elgg_echo('job:negotiable') => elgg_echo('job:negotiable'),
    elgg_echo('job:fixed') => elgg_echo('job:fixed'),
];
 
$title = elgg_view_field([
    '#label' => elgg_echo('title'),
    '#type' => 'text',
    'required' => true,
    'name' => 'title',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('title', $vars),
]);

$deadline = elgg_view_field([
    '#label' => elgg_echo('job:deadline'),
    '#type' => 'date',
    'required' => true,
    'name' => 'deadline',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('deadline', $vars),
]);

$overview = elgg_view_field([
    '#label' => elgg_echo('job:overview'),
    '#type' => 'longtext',
    'required' => true,
    'name' => 'overview',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('overview', $vars),
]);

$qualifications = elgg_view_field([
    '#label' => elgg_echo('job:qualifications'),
    '#type' => 'longtext',
    'required' => true,
    'name' => 'qualifications',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('qualifications', $vars),
]);

$responsabilities = elgg_view_field([
    '#label' => elgg_echo('job:responsabilities'),
    '#type' => 'longtext',
    'required' => false,
    'name' => 'responsabilities',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('responsabilities', $vars),
]);

$location = elgg_view_field([
    '#label' => elgg_echo('job:location'),
    '#type' => 'text',
    'required' => true,
    'name' => 'location',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('location', $vars),
]);

$openings = elgg_view_field([
    '#label' => elgg_echo('job:openings'),
    '#type' => 'text',
    'required' => true,
    'name' => 'openings',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('openings', $vars),
]);

$salary = elgg_view_field([
    '#label' => elgg_echo('job:salary'),
    '#type' => 'text',
    'required' => true,
    'name' => 'salary',
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('salary', $vars),
]);

$salaryType = elgg_view_field([
    '#label' => elgg_echo('job:salary_type'),
    '#type' => 'select',
    'required' => true,
    'name' => 'salary_type',
    'class' => 'job-dropdown',
    'options_values' => $salaryType,
    'value' => elgg_extract('salary_type', $vars),
    'multiple' => false,
]);


$jobType = elgg_view_field([
    '#label' => elgg_echo('job:type'),
    '#type' => 'select',
    'required' => true,
    'name' => 'job_type',
    'class' => 'job-dropdown',
    'options_values' => $options,
    'value' => elgg_extract('job_type', $vars),
    'multiple' => false,
]);

$jobExperience = elgg_view_field([
    '#label' => elgg_echo('job:experience'),
    '#type' => 'select',
    'required' => true,
    'name' => 'experience',
    'class' => 'job-dropdown',
    'options_values' => $experience,
    'value' => elgg_extract('experience', $vars),
    'multiple' => false,
]);

$status = elgg_view_field([
    '#label' => elgg_echo('status'),
    '#type' => 'select',
    'required' => true,
    'name' => 'status',
    'class' => 'job-dropdown',
    'options_values' => [
        'draft' => elgg_echo('status:draft'),
		'published' => elgg_echo('status:published')
    ],
    'value' => elgg_extract('status', $vars),
    'multiple' => false,
]);

$tags = elgg_view_field([
    '#label' => elgg_echo('job:skills'),
    '#type' => 'tags',
    'name' => 'tags',
    'id' => 'job_tags',
    'class' => 'w-full border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600',
    'value' => elgg_extract('tags', $vars),
]);

$accesId = elgg_view_field([
    '#label' => elgg_echo('access'),
    '#type' => 'access',
    'name' => 'access_id',
    'class' => 'job-dropdown',
    'value' => elgg_extract('access_id', $vars, ACCESS_DEFAULT),
    'entity' => elgg_extract('entity', $vars),
    'entity_type' => 'object',
    'entity_subtype' => 'bookmarks',
    'required' => true,
],);

$container = elgg_view_field([
    '#type' => 'container_guid',
    'value' => elgg_extract('container_guid', $vars),
    'entity_type' => 'object',
    'entity_subtype' => 'bookmarks',
]);

$hiddenField = elgg_view_field([
    '#type' => 'hidden',
    'name' => 'guid',
    'value' => elgg_extract('guid', $vars),
]);

$footer = elgg_view_field([
    '#type' => 'submit',
    'text' => elgg_echo('save'),
]);



 
$data['title_field'] = new \Twig\Markup($title, 'UTF-8');
$data['overview_field'] = new \Twig\Markup($overview, 'UTF-8');
$data['qualifications_field'] = new \Twig\Markup($qualifications, 'UTF-8');
$data['responsabilities_field'] = new \Twig\Markup($responsabilities, 'UTF-8');
$data['deadline_field'] = new \Twig\Markup($deadline, 'UTF-8');
$data['location_field'] = new \Twig\Markup($location, 'UTF-8');
$data['openings_field'] = new \Twig\Markup($openings, 'UTF-8');
$data['salary_field'] = new \Twig\Markup($salary, 'UTF-8');
$data['salary_type_field'] = new \Twig\Markup($salaryType, 'UTF-8');
$data['experience_field'] = new \Twig\Markup($jobExperience, 'UTF-8');
$data['type_field'] = new \Twig\Markup($jobType, 'UTF-8');
$data['tags_field'] = new \Twig\Markup($tags, 'UTF-8');
$data['access_id'] = new \Twig\Markup($accesId, 'UTF-8');
$data['status'] = new \Twig\Markup($status, 'UTF-8');
$data['site_url'] =  elgg_get_site_url();



$data['hidden_field'] = new \Twig\Markup($hiddenField, 'UTF-8');
$data['container_field'] = new \Twig\Markup($container, 'UTF-8');

$data['footer'] = new \Twig\Markup(($footer), 'UTF-8');


echo $twig->render(
    'job/forms/save.html.twig',
    [
        'data' => $data,
    ]
);
