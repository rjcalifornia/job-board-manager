<?php

/**
 * Elgg Jobs
 *
 * @property string $address URL of job
 */
class ElggResume extends ElggFile {

	/**
	 * {@inheritDoc}
	 */
	const SUBTYPE = 'resume';

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}

	public function __construct($guid = null) {
		parent::__construct($guid);
	}


  
     
     public function saveArchive($name) {
          $uf = get_uploaded_file($name);
          if (!$uf) {
              return FALSE;
          }
          $this->open("write");
          $this->write($uf);
          $this->close();
  
          return true;
      }

}
