<?php
class BlacklistRuleEnforcer extends Enforcer {

	public function enforce() {
		$subject = $this->getSubject();
		$rule = $this->getRuleObj();

		return RuleCacheBlacklistDao::validateSubjectInRule($subject, $rule->getId());
	}
}
?>