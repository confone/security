<?php
class GroupRuleHandler extends Handler {

	protected function handle($params) {
		$body = Utility::getJsonRequestData();

		$rules = $this->getValidator()->getRules();

		$errors = array();
		foreach ($rules as $rule) {
			if ($rule instanceof RuleThrottlingDao) {
				$subject = $body[$rule->getName()];
				$enforcher = new ThrottlingRuleEnforcer($rule, $subject);
			} 
			else if ($rule instanceof RuleBlacklistDao) {
				$subject = $body[$rule->getName()];
				$enforcher = new BlacklistRuleEnforcer($rule, $subject);
			} 
			else if ($rule instanceof RuleWhitelistDao) {
				$subject = $body[$rule->getName()];
				$enforcher = new WhitelistRuleEnforcer($rule, $subject);
			}

			if (!$enforcher->enforce()) {
				array_push($errors, $rule->getErrorMessage());
			}
		}

		if (empty($errors)) {
			return array('status'=>'success');
		} else {
			return array('status'=>'error', 'description'=>$errors);
		}
	}
}
?>