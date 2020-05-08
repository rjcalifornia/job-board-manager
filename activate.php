<?php
/**
 * Register the ElggBlog class for the object/blog subtype
 */

if (get_subtype_id('object', 'job-board-manager')) {
	update_subtype('object', 'job-board-manager', 'ElggJobBoardManager');
} else {
	add_subtype('object', 'job-board-manager', 'ElggJobBoardManager');
}

if (get_subtype_id('object', 'resumes')) {
	update_subtype('object', 'resumes', 'ElggResumes');
} else {
	add_subtype('object', 'resumes', 'ElggResumes');
}