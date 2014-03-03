<?php
class ThrottlingRuleValidator extends Validator {

	private $rules = null;

	public function validate() {
		$body = $this->getObjectToBeValidated();

		$indexes = array('subject');
		$valid = $this->nonEmptyArrayIndex($indexes, $body);
    	if (!$valid) {
    		header('HTTP/1.0 400 Bad Request');
    		return $valid;
    	}

    	$headers = apache_request_headers();

    	$valid = isset($headers['private-key']);
    	if (!$valid) {
    		header('HTTP/1.0 417 Expectation Failed');
    		$this->setErrorMessage('missing header private-key');
    		return $valid;
    	}

    	$application = ApplicationDao::getApplicationByPrivateKey($headers['private-key']);

    	$valid = $application->isFromDatabase();
    	if (!$valid) {
    		header('HTTP/1.0 404 Not Found');
    		$this->setErrorMessage('cannot find application');
    		return $valid;
    	}

    	$this->rules = array();

    	$appRules = ApplicationRulesDao::getRulesByApplicationId($application->var[ApplicationDao::IDCOLUMN]);

    	foreach ($appRules as $appRule) {
    		switch ($appRule->var[ApplicationRulesDao::RULETYPE]) {

    			case 'RuleThrottlingDao':
    				$valid = true;
    				$rule = new RuleThrottlingDao($appRule->var[ApplicationRulesDao::RULEID]);
    				array_push($this->rules, $rule);
    			break;

    			default :
    		}
    	}

    	return $valid;
	}

	public function getRules() {
		return $this->rules;
	}
}
?>