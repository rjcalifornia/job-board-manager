<?php

/**
 * Elgg Jobs
 *
 * @property string $address URL of job
 */
class ElggJobApplication extends ElggObject {

	/**
	 * {@inheritDoc}
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = 'job_application';
	}

}
