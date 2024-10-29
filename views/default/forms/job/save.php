<?php


$data['hidden_guid_input'] = '';
$guid = elgg_extract('guid', $vars, null);

$twig = jobs_twig();

if ($guid) {
    $hiddenGuid = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
    $data['hidden_guid_input'] = new \Twig\Markup($hiddenGuid, 'UTF-8');
}


$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);

$options =[
    'Full time',
    'Part time',
    'Per hours'
];
 
$title = elgg_view_field([
    '#label' => elgg_echo('title'),
    '#type' => 'text',
    'required' => true,
    'name' => 'title',
    'value' => elgg_extract('title', $vars),
]);

$overview = elgg_view_field([
    '#label' => elgg_echo('job:overview'),
    '#type' => 'longtext',
    'required' => true,
    'name' => 'overview',
    'value' => elgg_extract('overview', $vars),
]);

$qualifications = elgg_view_field([
    '#label' => elgg_echo('job:qualifications'),
    '#type' => 'longtext',
    'required' => true,
    'name' => 'qualifications',
    'value' => elgg_extract('qualifications', $vars),
]);

$responsabilities = elgg_view_field([
    '#label' => elgg_echo('job:responsabilities'),
    '#type' => 'longtext',
    'required' => false,
    'name' => 'responsabilities',
    'value' => elgg_extract('responsabilities', $vars),
]);

$salary = elgg_view_field([
    '#label' => elgg_echo('job:salary'),
    '#type' => 'text',
    'required' => false,
    'name' => 'salary',
    'value' => elgg_extract('salary', $vars),
]);

$jobType = elgg_view_field([
    '#label' => elgg_echo('job:type'),
    '#type' => 'select',
    'required' => true,
    'name' => 'job_type',
    'options_values' => $options,
    'value' => elgg_extract('job_type', $vars),
    'multiple' => false,
]);

$tags = elgg_view_field([
    '#label' => elgg_echo('job:skills'),
    '#type' => 'tags',
    'name' => 'tags',
    'id' => 'job_tags',
    'value' => elgg_extract('tags', $vars),
]);

$accesId = elgg_view_field([
    '#label' => elgg_echo('access'),
    '#type' => 'access',
    'name' => 'access_id',
    'value' => elgg_extract('access_id', $vars, ACCESS_DEFAULT),
    'entity' => elgg_extract('entity', $vars),
    'entity_type' => 'object',
    'entity_subtype' => 'bookmarks',
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
$data['salary_field'] = new \Twig\Markup($salary, 'UTF-8');
$data['type_field'] = new \Twig\Markup($jobType, 'UTF-8');
$data['tags_field'] = new \Twig\Markup($tags, 'UTF-8');
$data['access_id'] = new \Twig\Markup($accesId, 'UTF-8');



$data['hidden_field'] = new \Twig\Markup($hiddenField, 'UTF-8');
$data['container_field'] = new \Twig\Markup($container, 'UTF-8');

$data['footer'] = new \Twig\Markup(($footer), 'UTF-8');


echo $twig->render(
    'forms/save.html.twig',
    [
        'data' => $data,
    ]
);
