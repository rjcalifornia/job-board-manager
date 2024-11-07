<?php

namespace Elgg\Job\Forms;

/**
 * Prepare the fields for the job/save form
 *
 * @since 5.0
 */
class PrepareFields {
	
	/**
	 * Prepare fields
	 *
	 * @param \Elgg\Event $event 'form:prepare:fields', 'job/save'
	 *
	 * @return array
	 */
	public function __invoke(\Elgg\Event $event): array {
		$vars = $event->getValue();
		
		// input names => defaults
		$values = [
			'title' => null,
			'deadline' => null,
			'overview' => null,
			'qualifications' => null,
			'responsabilities' => null,
			'location' => null,
			'openings' => null,
			'salary' => null,
			'salary_type' => null,
			'job_type' => null,
			'experience' => null,
			 
			'status' => 'published',
			'access_id' => ACCESS_DEFAULT,
			 
			'excerpt' => null,
			'tags' => null,
			'container_guid' => null,
			'guid' => null,
		];
		
		$job = elgg_extract('entity', $vars);
		if ($job instanceof \ElggJob) {
			// load current job values
			foreach (array_keys($values) as $field) {
				if (isset($job->$field)) {
					$values[$field] = $job->$field;
				}
			}
			
			if ($job->status == 'draft') {
				$values['access_id'] = $job->future_access;
			}
			
			 
		}
		
		return array_merge($values, $vars);
	}
}
