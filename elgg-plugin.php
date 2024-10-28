<?php
 
require_once(__DIR__ . '/lib/functions.php');

return [
        'plugin' => [
		'name' => 'Job Manager',
		'activate_on_install' => false,
	],
        'entities' => [
                [
                        'type' => 'object',
                        'subtype' => 'job',
                        'class' => 'ElggJob',
                        'capabilities' => [
                                'commentable' => true,
				'searchable' => true,
				'likable' => true,
				'restorable' => true,
                        ],
                ],
        ],
        'actions' => [
		'job/save' => [],
	],
	'routes' => [

		'add:object:job' => [
                        'path' => '/job/add/{guid}',
                        'resource' => 'job/add',
                        'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
				\Elgg\Router\Middleware\PageOwnerGatekeeper::class,
			],
                ],
	],
];