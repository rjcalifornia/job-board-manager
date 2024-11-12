<?php
/**
 * Jobs sidebar
 */
$twig = jobs_twig();
$view_mode = elgg_extract('single', $vars);
$data = [
    'view_mode' => $view_mode
];




 echo $twig->render(
    'job/elements/sidebar.html.twig',
    [
        'data' => $data,
    ]
);