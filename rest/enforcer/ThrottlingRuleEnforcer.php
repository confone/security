<?php
class ThrottlingRuleEnforcer extends Enforcer {

	public function enforce() {
		$subject = $this->getSubject();
		$subject = hash('md4', $subject).'.'.strlen($subject);
		$rule = $this->getRuleObj();

		$end = strtotime('now');
		

		$ruleId = $rule->getId();
		$waitTime = $rule->getWaitTime();

		$mem = CacheUtil::getInstance();
		$waitFlag = $mem->get($ruleId.$subject);

		if ($waitFlag) {
			$waitFlag = !RuleCacheThrottlingDao::passWaitTime($ruleId, $subject, $end, $waitTime);
			if (!$waitFlag) {
				$mem->set($ruleId.$subject, 0);
			} else {
				$valid = false;
			}
		}

		if (!$waitFlag) {
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

			if (!$valid) {
				$mem->set($ruleId.$subject, 1);
			}
		}

		return $valid;
	}
}
?>