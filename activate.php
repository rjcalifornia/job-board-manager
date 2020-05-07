<?php
/**
 * Register the ElggBlog class for the object/blog subtype
 */

if (get_subtype_id('object', 'job_board_manager')) {
	update_subtype('object', 'job_board_manager', 'ElggJobBoardManager');
} else {
	add_subtype('object', 'job_board_manager', 'ElggJobBoardManager');
}
