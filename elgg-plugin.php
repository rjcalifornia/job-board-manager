<?php



return [
	'plugin' => [
		'name' => 'Job Board Manager for Elgg',
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
		'collection:object:job:owner' => [
			'path' => '/job/owner/{username}/{lower?}/{upper?}',
			'resource' => 'job/owner',
			'requirements' => [
				'lower' => '\d+',
				'upper' => '\d+',
			],
			'middleware' => [
				\Elgg\Router\Middleware\UserPageOwnerGatekeeper::class,
			],
		],
	 
		'view:object:job' => [
			'path' => '/job/view/{guid}/{title?}',
			'resource' => 'job/view',
		],
		'add:object:job' => [
			'path' => '/job/add/{guid}',
			'resource' => 'job/add',
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
				\Elgg\Router\Middleware\PageOwnerGatekeeper::class,
			],
		],
		'edit:object:job' => [
			'path' => '/job/edit/{guid}/{revision?}',
			'resource' => 'job/edit',
			'requirements' => [
				'revision' => '\d+',
			],
			'middleware' => [
				\Elgg\Router\Middleware\Gatekeeper::class,
			],
		],
		'collection:object:job:group' => [
			'path' => '/job/group/{guid}/{subpage?}/{lower?}/{upper?}',
			'resource' => 'job/group',
			'defaults' => [
				'subpage' => 'all',
			],
			'requirements' => [
				'subpage' => 'all|archive',
				'lower' => '\d+',
				'upper' => '\d+',
			],
			'required_plugins' => [
				'groups',
			],
			'middleware' => [
				\Elgg\Router\Middleware\GroupPageOwnerGatekeeper::class,
			],
		],
		'collection:object:job:all' => [
			'path' => '/job/all/{lower?}/{upper?}',
			'resource' => 'job/all',
			'requirements' => [
				'lower' => '\d+',
				'upper' => '\d+',
			],
		],
		'default:object:job' => [
			'path' => '/job',
			'resource' => 'job/all',
		],
	],
	'events' => [
		'container_logic_check' => [
			'object' => [
				GroupToolContainerLogicCheck::class => [],
			],
		],
		'entity:url' => [
			'object:widget' => [
				'Elgg\Job\Widgets::JobWidgetUrl' => [],
			],
		],
		'form:prepare:fields' => [
			'job/save' => [
				PrepareFields::class => [],
			],
		],
		'register' => [
			'menu:job_archive' => [
				'Elgg\Job\Menus\JobArchive::register' => [],
			],
			'menu:owner_block' => [
				'Elgg\Job\Menus\OwnerBlock::registerUserItem' => [],
				'Elgg\Job\Menus\OwnerBlock::registerGroupItem' => [],
			],
			'menu:site' => [
				'Elgg\Job\Menus\Site::register' => [],
			],
			'menu:title:object:job' => [
				\Elgg\Notifications\RegisterSubscriptionMenuItemsHandler::class => [],
			],
		],
		'seeds' => [
			'database' => [
				'Elgg\Job\Seeder::register' => [],
			],
		],
	],
	'widgets' => [
		'job' => [
			'context' => ['profile', 'dashboard'],
		],
	],
	'group_tools' => [
		'job' => [],
	],
	'notifications' => [
		'object' => [
			'job' => [
				'publish' => PublishJobEventHandler::class,
				'mentions' => \Elgg\Notifications\MentionsEventHandler::class,
			],
		],
	],
];
