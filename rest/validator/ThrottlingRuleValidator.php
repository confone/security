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

    	$this->rules = array();

    	global $_APPLICATION;
    	$appRules = ApplicationRulesDao::getRulesByApplicationId($_APPLICATION->getId());

    	foreach ($appRules as $appRule) {
    		$ruleType = $appRule->getRuleType(); 

    		if ($ruleType == ApplicationRulesDao::RULE_TYPE_THROTTLING) {
    			$valid = true;
    			$rule = new RuleThrottlingDao($appRule->getRuleId());
    			array_push($this->rules, $rule);
    		}
    	}

    	return $valid;
	}

	public function getRules() {
		return $this->rules;
	}
}
?>