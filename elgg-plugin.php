<?php
 
require_once(__DIR__ . '/lib/functions.php');

return [
	'routes' => [

		'add:object:job' => [
                        'path' => '/job/add/{guid?}',
                        'resource' => 'job/add',
                ],
	],
];