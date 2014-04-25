<?php
class WhitelistRuleEnforcer extends Enforcer {

	public function enforce() {
		$subject = $this->getSubject();
		$rule = $this->getRuleObj();

		return RuleCacheWhitelistDao::validateSubjectInRule($subject, $rule->getId());
	}
}
?>