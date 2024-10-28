<?php

/**
 * Elgg Jobs
 *
 * @property string $address URL of bookmark
 */
class ElggJob extends ElggObject {

	/**
	 * {@inheritDoc}
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = 'job';
	}
}
