<?php
class ThrottlingRuleValidator extends Validator {

	private $rules = null;

	public function validate() {
		$body = $this->getObjectToBeValidated();

    	$headers = apache_request_headers();

    	$valid = isset($headers['private_key']);

    	$application = ApplicationDao::getApplicationByPrivateKey($headers['private_key']);

    	$this->rules = array();

    	$appRules = ApplicationRulesDao::getRulesByApplicationId($application->var[ApplicationDao::IDCOLUMN]);

    	foreach ($appRules as $appRule) {
    		switch ($appRule->var[ApplicationRulesDao::RULETYPE]) {

    			case 'RuleThrottlingDao':
    				$rule = new RuleThrottlingDao($appRule->var[ApplicationRulesDao::RULEID]);
    				array_push($this->rules, $rule);
    			break;

    			default :
    		}
    	}
	}

	public function getRules() {
		return $this->rules;
	}
}
?>