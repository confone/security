<?php
class TokenRuleCreateValidator extends Validator {

	private $rule = null;

	public function validate() {
		$input = $this->getObjectToBeValidated();

		$indexes = array('groupname', 'subject');
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

    	$appRules = GroupRulesDao::getRulesByApplicationIdAndGroupId($_APPLICATIONID, $groupId);

    	foreach ($appRules as $appRule) {
    		if ($appRule->getRuleType()==GroupRulesDao::RULE_TYPE_TOKEN) {
	    		$rule = new RuleTokenDao($appRule->getRuleId());
	    		if ($rule->getName()==$input['subject']) {
	    			$this->rule = $rule;
	    			return true;
	    		}
    		}
	    }

	    return false;
	}

	public function getRule() {
		return $this->rule;
	}
}
?>