<?php
/**
 * Jobs sidebar
 */
$twig = jobs_twig();
$view_mode = elgg_extract('single', $vars);

$defaults = [
	'type' => 'object',
	'subtype' => 'job',
	'full_view' => false, 
	'distinct' => false,
    'limit' => 2,
];

$options = (array) elgg_extract('options', $vars, []);
$options = array_merge($defaults, $options);

$entities= elgg_get_entities($defaults);

foreach ($entities as $entity) {
	$entity->url = $entity->getUrl();
}
 

$data = [
    'site_url' => elgg_get_site_url(),
    'entities' => $entities,
    'view_mode' => $view_mode,
];




 echo $twig->render(
    'job/elements/sidebar.html.twig',
    [
        'data' => $data,
    ]
);