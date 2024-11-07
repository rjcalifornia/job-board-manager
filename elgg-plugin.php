<?php
 
require_once(__DIR__ . '/lib/functions.php');

return [

	//Plugin information
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

	//Plugin routes. It would be better to have a routes files, like in Laravel though.
	'routes' => [
                'default:object:job' => [
			'path' => '/jobs',
			'resource' => 'job/all',
		],

		'collection:object:job:all' => [
			'path' => '/jobs/all',
			'resource' => 'job/all',
		],
		'add:object:job' => [
                        'path' => '/job/add/{guid}',
                        'resource' => 'job/add',
                        'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
				\Elgg\Router\Middleware\PageOwnerGatekeeper::class,
			],
                ],

		'view:object:job' => [
			'path' => '/jobs/view/{guid}/{title?}',
			'resource' => 'job/view',
		],
	],

	//Site menu
	'events' => [

		//Register menu here
		'register' => [
			'menu:site' => [
				'Elgg\Job\Menus\Site::register' => [],
			],

		'menu:owner_block' => [
				'Elgg\Job\Menus\OwnerBlock::registerUserItem' => [],
				 
			],

		'menu:title:object:job' => [
				\Elgg\Notifications\RegisterSubscriptionMenuItemsHandler::class => [],
			],
		],
	],
];