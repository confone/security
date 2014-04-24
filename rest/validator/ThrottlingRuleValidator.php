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

    	global $_APPLICATIONID, $_GROUPID;

    	$this->rules = array();

    	$appRules = GroupRulesDao::getRulesByApplicationIdAndGroupId($_APPLICATIONID, $_GROUPID);

    	foreach ($appRules as $appRule) {
    		$ruleType = $appRule->getRuleType(); 

    		if ($ruleType == GroupRulesDao::RULE_TYPE_THROTTLING) {
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