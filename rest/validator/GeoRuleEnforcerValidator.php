<?php
class GeoRuleEnforcerValidator extends Validator {
	
	private $rules = null;

	public function validate() {
		$input = $this->getObjectToBeValidated();

		$indexes = array('subject', 'lat', 'lng');
		$valid = $this->nonEmptyArrayIndex($indexes, $input);
    	if (!$valid) {
    		header('HTTP/1.0 400 Bad Request');
    		return $valid;
    	}

    	return true;
	}

	public function getMessage() {
		$message = parent::getMessage();
		return $message['description'];
	}
}
?>