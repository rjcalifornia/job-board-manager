<?php
/**
 * Delete job entity
 *
 * @package Job Board Manager
 */

$job_guid = get_input('guid');
$job = get_entity($job_guid);

if (elgg_instanceof($job, 'object', 'job-board-manager') && $job->canEdit()) {
	$container = get_entity($job->container_guid);
	if ($job->delete()) {
		system_message(elgg_echo('job:message:deleted_post'));
		if (elgg_instanceof($container, 'group')) {
			forward("job-board-manager/group/$container->guid/all");
		} else {
			forward("job-board-manager/all/");
		}
	} else {
		register_error(elgg_echo('job:error:cannot_delete_post'));
	}
} else {
	register_error(elgg_echo('job:error:post_not_found'));
}

forward(REFERER);