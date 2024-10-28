<?php
/**
 * Add bookmark page
 */

use Elgg\Exceptions\Http\EntityPermissionsException;

$page_owner = elgg_get_page_owner_entity();
if (!$page_owner->canWriteToContainer(0, 'object', 'job')) {
	throw new EntityPermissionsException();
}

elgg_push_collection_breadcrumbs('object', 'job', $page_owner);

echo elgg_view_page(elgg_echo('add:object:job'), [
	'filter_id' => 'job/edit',
	'content' => elgg_view_form('job/save', ['sticky_enabled' => true]),
]);
