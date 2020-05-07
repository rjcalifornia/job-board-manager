<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

elgg_register_event_handler('init', 'system', 'job_board_manager_init');

function job_board_manager_init() {

	elgg_register_library('elgg:job_board_manager', __DIR__ . '/lib/job_board_manager.php');

	// add a site navigation item
	$item = new ElggMenuItem('job_board_manager', elgg_echo('job:board:jobs'), 'job_board_manager/all');
	elgg_register_menu_item('site', $item);

	//elgg_register_event_handler('upgrade', 'upgrade', 'blog_run_upgrades');

	// add to the main css
	//elgg_extend_view('elgg.css', 'job_board_manager/css');

	// routing of urls
	elgg_register_page_handler('job_board_manager', 'job_board_manager_page_handler');

	// override the default url to view a blog object
	elgg_register_plugin_hook_handler('entity:url', 'object', 'job_board_manager_set_url');

	// notifications
	elgg_register_notification_event('object', 'job_board_manager', array('publish'));
	//elgg_register_plugin_hook_handler('prepare', 'notification:publish:object:job-board-manager', 'job_board-manager_prepare_notification');

	// add blog link to
	//elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'blog_owner_block_menu');

	// pingbacks
	//elgg_register_event_handler('create', 'object', 'blog_incoming_ping');
	//elgg_register_plugin_hook_handler('pingback:object:subtypes', 'object', 'blog_pingback_subtypes');

	// Register for search.
	elgg_register_entity_type('object', 'job_board_manager');

	// Add group option
	//add_group_tool_option('blog', elgg_echo('blog:enableblog'), true);
	//elgg_extend_view('groups/tool_latest', 'blog/group_module');

	// add a blog widget
	//elgg_register_widget_type('blog', elgg_echo('blog'), elgg_echo('blog:widget:description'));

	// register actions
	$action_path = __DIR__ . '/actions/job_board_manager';
	//elgg_register_action('blog/save', "$action_path/save.php");
	//elgg_register_action('blog/auto_save_revision', "$action_path/auto_save_revision.php");
	//elgg_register_action('blog/delete', "$action_path/delete.php");

	// entity menu
	//elgg_register_plugin_hook_handler('register', 'menu:entity', 'blog_entity_menu_setup');

	// ecml
	//elgg_register_plugin_hook_handler('get_views', 'ecml', 'blog_ecml_views_hook');

	// allow to be liked
	//elgg_register_plugin_hook_handler('likes:is_likable', 'object:blog', 'Elgg\Values::getTrue');
}

function job_board_manager_set_url($hook, $type, $url, $params) {
    $entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'job_board_manager')) {
		$friendly_title = elgg_get_friendly_title($entity->title);
		return "job_board_manager/view/{$entity->guid}/$friendly_title";
	}
}



function job_board_manager_page_handler($page) {
    
    elgg_load_library('elgg:job_board_manager');
    
    elgg_push_breadcrumb(elgg_echo('job:board:jobs'), 'job_board_manager/all');
    
    $page_type = elgg_extract(0, $page, 'all');
	$resource_vars = [
		'page_type' => $page_type,
	];

	switch ($page_type) {
		 
		case 'add':
			$resource_vars['guid'] = elgg_extract(1, $page);
			
			echo elgg_view_resource('job_board_manager/add', $resource_vars);
			break;
		 
		 
		case 'all':
			echo elgg_view_resource('job_board_manager/all', $resource_vars);
			break;
                    
                case 'edit':
			$resource_vars['guid'] = elgg_extract(1, $page);
			$resource_vars['revision'] = elgg_extract(2, $page);
			 
			echo elgg_view_resource('job_board_manager/edit', $resource_vars);
			break;
		default:
			return false;
	}

	return true;
}
