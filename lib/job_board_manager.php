<?php

/**
 * Get page components to list a user's or all blogs.
 *
 * @param int $container_guid The GUID of the page owner or NULL for all blogs
 * @return array
 */
function job_board_manager_get_page_content_list($container_guid = NULL) {

	$return = array();

	$return['filter_context'] = $container_guid ? 'mine' : 'all';

	$options = array(
		'type' => 'object',
		'subtype' => 'job_board_manager',
		'full_view' => false,
		'no_results' => elgg_echo('job:board:none'),
		'preload_owners' => true,
		'distinct' => false,
	);

	$current_user = elgg_get_logged_in_user_entity();

	if ($container_guid) {
		// access check for closed groups
		elgg_group_gatekeeper();

		$container = get_entity($container_guid);
		if ($container instanceof ElggGroup) {
		$options['container_guid'] = $container_guid;
		} else {
			$options['owner_guid'] = $container_guid;
		}
		$return['title'] = elgg_echo('job:board:title:user_jobs', array($container->name));

		$crumbs_title = $container->name;
		elgg_push_breadcrumb($crumbs_title);

		if ($current_user && ($container_guid == $current_user->guid)) {
			$return['filter_context'] = 'mine';
		} else if (elgg_instanceof($container, 'group')) {
			$return['filter'] = false;
		} else {
			// do not show button or select a tab when viewing someone else's posts
			$return['filter_context'] = 'none';
		}
	} else {
		$options['preload_containers'] = true;
		$return['filter_context'] = 'all';
		$return['title'] = elgg_echo('job:board:title:all_jobs');
		elgg_pop_breadcrumb();
		elgg_push_breadcrumb(elgg_echo('job:board:jobs'));
	}

	elgg_register_title_button('job_board_manager', 'add', 'object', 'job_board_manager');

	$return['content'] = elgg_list_entities($options);

	return $return;
}



/**
 * Get page components to edit/create a blog post.
 *
 * @param string  $page     'edit' or 'new'
 * @param int     $guid     GUID of blog post or container
 * @param int     $revision Annotation id for revision to edit (optional)
 * @return array
 */
function job_board_get_page_content_edit($page, $guid = 0, $revision = NULL) {

	//elgg_require_js('elgg/job-board-manager/save_draft');

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'blog-post-edit';
	$vars['class'] = 'elgg-form-alt';

	$sidebar = '';
	if ($page == 'edit') {
		$jobBoardManager = get_entity((int)$guid);

		$title = elgg_echo('job:board:edit');

		if (elgg_instanceof($jobBoardManager, 'object', 'job_board_manager') && $jobBoardManager->canEdit()) {
			$vars['entity'] = $jobBoardManager;

			$title .= ": \"$jobBoardManager->title\"";

			if ($revision) {
				$revision = elgg_get_annotation_from_id((int)$revision);
				$vars['revision'] = $revision;
				$title .= ' ' . elgg_echo('job:board:edit_revision_notice');

				if (!$revision || !($revision->entity_guid == $guid)) {
					$content = elgg_echo('job:board:error:revision_not_found');
					$return['content'] = $content;
					$return['title'] = $title;
					return $return;
				}
			}

			$body_vars = job_board_manager_prepare_form_vars($jobBoardManager, $revision);

			elgg_push_breadcrumb($jobBoardManager->title, $jobBoardManager->getURL());
			elgg_push_breadcrumb(elgg_echo('edit'));
			
			//elgg_require_js('elgg/job-board-manager/save_draft');

			$content = elgg_view_form('job_board_manager/save', $vars, $body_vars);
			$sidebar = elgg_view('job_board_manager/sidebar/revisions', $vars);
		} else {
			$content = elgg_echo('job:board:error:cannot_edit_post');
		}
	} else {
		elgg_push_breadcrumb(elgg_echo('job:board:add'));
		$body_vars = job_board_manager_prepare_form_vars(null);

		$title = elgg_echo('job:board:add');
		$content = elgg_view_form('job_board_manager/save', $vars, $body_vars);
	}

	$return['title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;
}





/**
 * Pull together blog variables for the save form
 *
 * @param ElggBlog       $post
 * @param ElggAnnotation $revision
 * @return array
 */
function job_board_manager_prepare_form_vars($jobBoard = NULL, $revision = NULL) {
    
    
	// input names => defaults
	$values = array(
		'title' => NULL,
		'description' => NULL,
                'total_openings' => NULL,
                'job_type' => NULL,
                'job_level' => NULL,
                'years_experience' => NULL,
                'salary_type' => NULL,
                'fixed_salary' => NULL,
                'salary_duration' => NULL,
                'salary_currency' => NULL,
                'company_name' => NULL,
                'company_location' => NULL,
                'company_address' => NULL,
                'company_website' => NULL,                            
		'status' => 'published',
		'access_id' => ACCESS_DEFAULT,
		'comments_on' => 'On',
               
		'excerpt' => NULL,
		'tags' => NULL,
		'container_guid' => NULL,
		'guid' => NULL,
		'draft_warning' => '',
	);

	if ($jobBoard) {
		foreach (array_keys($values) as $field) {
			if (isset($jobBoard->$field)) {
				$values[$field] = $jobBoard->$field;
			}
		}

		if ($jobBoard->status == 'draft') {
			$values['access_id'] = $jobBoard->future_access;
		}
	}

	if (elgg_is_sticky_form('job_board_manager')) {
		$sticky_values = elgg_get_sticky_values('job_board_manager');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('job_board_manager');

	if (!$jobBoard) {
		return $values;
	}

	

	
	return $values;
}


?>