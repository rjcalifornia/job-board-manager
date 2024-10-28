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

 
$titleField = elgg_view_field([
    '#label' => elgg_echo('title'),
		'#type' => 'text',
		'required' => true,
		'name' => 'title',
		'value' => elgg_extract('title', $vars),
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



 
$data['title_field'] = new \Twig\Markup($titleField, 'UTF-8');
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
