<?php

use Elgg\Job\Forms\PrepareFields;

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
		[
			'type' => 'object',
			'subtype' => 'job_application',
			'class' => 'ElggJobApplication',
			'capabilities' => [
				'commentable' => false,
				'searchable' => false,
				'likable' => false,
				'restorable' => false,
			],
		],
		[
			'type' => 'object',
			'subtype' => 'resume',
			'class' => 'ElggResume',
			'capabilities' => [
				'commentable' => false,
				'searchable' => false,
				'likable' => false,
				'restorable' => false,
			],
		],

	],
	'actions' => [
		'job/save' => [],

		'job/apply' => [
         'access' => 'public',
      ],
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

		//Add new job opening
		'add:object:job' => [
			'path' => '/job/add/{guid}',
			'resource' => 'job/add',
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
				\Elgg\Router\Middleware\PageOwnerGatekeeper::class,
			],
		],

		//View job details
		'view:object:job' => [
			'path' => '/jobs/view/{guid}/{title?}',
			'resource' => 'job/view',
		],


		//Edit job details
		'edit:object:job' => [
			'path' => '/jobs/edit/{guid}/{revision?}',
			'resource' => 'job/edit',
			'requirements' => [
				'revision' => '\d+',
			],
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
			],
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

		'form:prepare:fields' => [
			'job/save' => [
				PrepareFields::class => [],
			],
		],
	],
];
