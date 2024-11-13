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
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = 'resume';
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
