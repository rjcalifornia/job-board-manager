<?php

$autoload_path = __DIR__ . '/../vendor/autoload.php';
require_once($autoload_path);

function jobs_twig(){
    $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../resources');
	$twig = new \Twig\Environment($loader, [
		'cache' => false,
	]);

    return $twig;
}