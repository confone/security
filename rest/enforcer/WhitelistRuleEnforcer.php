<?php
class WhitelistRuleEnforcer extends Enforcer {

	public function enforce() {
		$subject = $this->getSubject();
		$rule = $this->getRuleObj();

		return !RuleCacheWhitelistDao::subjectExistInRule($subject, $rule->getId());
	}
}
?>