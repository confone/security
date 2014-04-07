<?php
class ThrottlingRuleEnforcer extends Enforcer {

	public function enforce() {
		$rule = $this->getRuleObj();
		$subject = $this->getSubject();

		$ruleId = $rule->getId();
		$end = strtotime('now');
		$duration = $rule->getDuration();
		$start = $end - $duration;

		try {
			$count = RuleCacheThrottlingDao::countSubject($ruleId, $subject, $start, $end);

			$allowance = $rule->getAllowance();

			$valid = ($count < $allowance);

			$cache = new RuleCacheThrottlingDao();
			$cache->setRuleId($ruleId);
			$cache->setSubject($subject);
			$cache->setTime($end);
			$cache->save();

			RuleCacheThrottlingDao::removeOldCache($ruleId, $subject, $start);
		} catch (Exception $e) { $valid = true; }

		return $valid;
	}
}
?>