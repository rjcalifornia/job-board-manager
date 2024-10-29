<?php

/**
 * Elgg Jobs
 *
 * @property string $address URL of job
 */
class ElggJob extends ElggObject {

	/**
	 * {@inheritDoc}
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = 'job';
	}

	public function getSummary(int $length = 250): string {
		$summary = $this->overview ;
		
		return elgg_get_excerpt((string) $summary, $length);
	}
}
