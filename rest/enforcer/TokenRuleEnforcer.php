<?php
class TokenRuleEnforcer extends Enforcer {

	public function enforce() {
		$subject = $this->getSubject();
		$rule = $this->getRuleObj();

		return RuleCacheTokenDao::ruleSubjectTokenExist($rule->getId(), $subject);
	}
}
?>