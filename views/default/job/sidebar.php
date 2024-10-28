<?php
/**
 * Jobs sidebar
 */
$twig = jobs_twig();

 echo $twig->render(
    'elements/sidebar.html.twig',
    [
        'data' => $data,
    ]
);