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


$titleLabel = elgg_echo('job:add:title');
$titleInput = elgg_view('input/text', array('name' => 'title', 'value' => $title));

$hiddenContainer = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

$footer = elgg_view_field([
    '#type' => 'submit',
    'id' => 'share',
    'value' => elgg_echo('save'),
]);




$data['title_label'] = $titleLabel;
$data['title_input'] = new \Twig\Markup($titleInput, 'UTF-8');



$data['hidden_container_input'] = new \Twig\Markup($hiddenContainer, 'UTF-8');

$data['footer'] = new \Twig\Markup(($footer), 'UTF-8');


echo $twig->render(
    'forms/save.html.twig',
    [
        'data' => $data,
    ]
);
