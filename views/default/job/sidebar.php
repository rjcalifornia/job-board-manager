<?php
/**
 * Jobs sidebar
 */
$twig = jobs_twig();
$data = [];

 echo $twig->render(
    'elements/sidebar.html.twig',
    [
        'data' => $data,
    ]
);