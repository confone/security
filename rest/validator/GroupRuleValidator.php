<?php
class GroupRuleValidator extends Validator {

	private $rules = null;

	public function validate() {
		$input = $this->getObjectToBeValidated();

		$indexes = array('groupname');
		$valid = $this->nonEmptyArrayIndex($indexes, $input);
    	if (!$valid) {
    		header('HTTP/1.0 400 Bad Request');
    		return $valid;
    	}

    	global $_APPLICATIONID;

   		$groupId = AppGroupDao::getGroupIdByAppIdAndGroupName ( 
	   							$_APPLICATIONID, $input['groupname'] );
   		$valid = ($groupId>0);
    	if (!$valid) {
        	header('HTTP/1.0 404 Not Found');
        	$this->setErrorMessage('\''.$input['groupname'].'\' does not exist');
    		return $valid;
   		}

    	$this->rules = array();

    	$appRules = GroupRulesDao::getRulesByApplicationIdAndGroupId($_APPLICATIONID, $groupId);

    	foreach ($appRules as $appRule) {
    		switch ($appRule->getRuleType()) {
    			case GroupRulesDao::RULE_TYPE_THROTTLING :
	    			$rule = new RuleThrottlingDao($appRule->getRuleId());
	    			$valid = !empty($input[$rule->getName()]);
	    			array_push($this->rules, $rule);
    			break;

    			case GroupRulesDao::RULE_TYPE_BLACKLIST :
	    			$rule = new RuleBlacklistDao($appRule->getRuleId());
	    			$valid = !empty($input[$rule->getName()]);
	    			array_push($this->rules, $rule);
    			break;

    			case GroupRulesDao::RULE_TYPE_WHITELIST :
	    			$rule = new RuleWhitelistDao($appRule->getRuleId());
	    			$valid = !empty($input[$rule->getName()]);
	    			array_push($this->rules, $rule);
    			break;
    		}

    		if (!$valid) {
    			header('HTTP/1.0 400 Bad Request');
    			$this->setErrorMessage('missing parameter \''.$rule->getName().'\'');
    			return $valid;
    		}
    	}

    	return $valid;
	}

	public function getRules() {
		return $this->rules;
	}
}
?>